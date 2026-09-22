<?php

namespace App\Services;

use App\Models\Faq;
use App\Models\Keyword;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiChatService
{
    /**
     * Algoritma pencocokan keyword seperti DeepSeek
     */
    public function getAnswer(string $question): array
    {
        // 1. Validasi input kosong
        if (empty(trim($question))) {
            return [
                'status' => 'empty',
                'answer' => __('messages.ai_empty'),
                'faq' => null
            ];
        }

        // 2. Normalisasi teks
        $normalized = $this->normalizeText($question);
        
        // Cek kondisi darurat (Red Flag Triage)
        $isEmergency = preg_match('/(darah|berdarah|nanah|sesak.*napas|susah.*napas|nyeri.*hebat|sakit.*hebat|pingsan|tidak sadar|kecelakaan|luka.*parah|darurat|kritis|koma)/i', $question);
        
        if ($isEmergency) {
            return [
                'status' => 'emergency',
                'answer' => __('messages.ai_emergency'),
                'faq' => null,
                'confidence' => 100
            ];
        }
        
        // Cek larangan medis (diagnosa, obat, biaya tindakan detail) sesuai UU
        $isAskingMedical = preg_match('/(diagnosa|sakit apa|penyakit apa|gejala.*penyakit|apa.*obat|obat.*untuk|resep obat|biaya.*operasi|biaya.*tindakan|biaya.*perawatan|harga.*operasi|harga.*tindakan|cara.*mengobati|cara.*menyembuhkan)/i', $question);
        
        if ($isAskingMedical) {
            return [
                'status' => 'restricted',
                'answer' => __('messages.ai_restricted'),
                'faq' => null,
                'confidence' => 100
            ];
        }
        
        // 3. Tokenisasi + filter stopwords
        $tokens = $this->tokenize($normalized);
        
        if (empty($tokens)) {
            return $this->notFoundResponse($question);
        }

        // 4. Cari FAQ berdasarkan keyword
        $faqs = $this->findFaqsByKeywords($tokens);
        
        if ($faqs->isEmpty()) {
            return $this->notFoundResponse($question);
        }

        // 5. Scoring system (seperti DeepSeek rank)
        $scored = $this->scoreFaqs($faqs, $normalized);
        
        // 6. Ambil yang tertinggi
        $best = $scored->first();
        
        if (!$best) {
            return $this->notFoundResponse($question);
        }
        
        // 7. Update hit count
        $best['faq']->increment('hit_count');
        
        // 8. Generate natural response with Groq using FAQ context
        $groqResponse = $this->callGroq($question, $best['faq']);
        $finalAnswer = $groqResponse ?: $best['faq']->answer; // Fallback to exact answer if Groq fails
        
        // 9. Sentiment Analysis (Deteksi Kepanikan)
        $isAnxious = preg_match('/(cemas|takut|panik|bingung|khawatir|tolong|bahaya|parah|!!!)/i', $question);
        if ($isAnxious) {
            $preamble = __('messages.ai_anxious_preamble');
            $finalAnswer = $preamble . $finalAnswer;
        }

        // 10. Dapatkan Follow-up Questions (Saran Pertanyaan)
        // Ambil 3 FAQ aktif secara acak selain yang sedang diakses
        $followUps = Faq::active()
            ->where('id', '!=', $best['faq']->id)
            ->inRandomOrder()
            ->limit(3)
            ->pluck('question')
            ->toArray();
        
        return [
            'status' => 'found',
            'answer' => $finalAnswer,
            'faq' => $best['faq'],
            'confidence' => $best['score'],
            'follow_ups' => $followUps
        ];
    }

    /**
     * Normalisasi: lower case, hapus simbol
     */
    private function normalizeText(string $text): string
    {
        $text = strtolower($text);
        $text = preg_replace('/[^a-z0-9\s]/', ' ', $text);
        $text = preg_replace('/\s+/', ' ', $text);
        return trim($text);
    }

    /**
     * Tokenisasi dan filter stopwords
     */
    private function tokenize(string $text): array
    {
        $stopwords = ['apa', 'bagaimana', 'mengapa', 'kapan', 'siapa', 
                     'di', 'ke', 'dari', 'yang', 'dan', 'atau', 'ini', 
                     'itu', 'saya', 'aku', 'kamu', 'dia'];
        
        $tokens = explode(' ', $text);
        $tokens = array_filter($tokens, function($token) use ($stopwords) {
            return !in_array($token, $stopwords) && strlen($token) > 1;
        });
        
        return array_values($tokens);
    }

    /**
     * Cari FAQ berdasarkan keyword
     */
    private function findFaqsByKeywords(array $tokens)
    {
        return Faq::active()
            ->whereHas('keywords', function($query) use ($tokens) {
                $query->where(function($q) use ($tokens) {
                    foreach ($tokens as $token) {
                        $q->orWhere('keyword', 'LIKE', '%' . $token . '%');
                    }
                });
            })
            ->with('keywords')
            ->get();
    }

    /**
     * Scoring FAQ dengan sistem bobot
     */
    private function scoreFaqs($faqs, string $normalizedText)
    {
        $scored = [];
        
        foreach ($faqs as $faq) {
            $score = 0;
            $matchedKeywords = [];
            
            foreach ($faq->keywords as $keyword) {
                if (str_contains($normalizedText, $keyword->keyword)) {
                    $score += $keyword->weight;
                    $matchedKeywords[] = $keyword->keyword;
                    
                    // Bonus untuk keyword yang match persis dengan token
                    if (Str::contains(strtolower($faq->question), $keyword->keyword)) {
                        $score += 0.5;
                    }
                }
            }
            
            if ($score > 0) {
                // Bonus untuk pertanyaan yang sering ditanyakan
                $score += log($faq->hit_count + 1) * 0.1;
                
                $scored[] = [
                    'faq' => $faq,
                    'score' => $score,
                    'matched_keywords' => $matchedKeywords
                ];
            }
        }
        
        // Urutkan berdasarkan score tertinggi
        usort($scored, function($a, $b) {
            return $b['score'] <=> $a['score'];
        });
        
        return collect($scored);
    }

    /**
     * Response untuk pertanyaan tidak ditemukan
     */
    private function notFoundResponse(string $question): array
    {
        // Coba tanya Groq tanpa konteks khusus
        $groqResponse = $this->callGroq($question, null);

        if ($groqResponse) {
            return [
                'status' => 'found_ai',
                'answer' => $groqResponse,
                'faq' => null,
                'confidence' => 50
            ];
        }

        return [
            'status' => 'not_found',
            'answer' => __('messages.ai_not_found'),
            'faq' => null
        ];
    }

    /**
     * Integrasi Groq Cloud API
     */
    private function callGroq(string $question, ?Faq $faqContext): ?string
    {
        $apiKey = config('services.groq.api_key');
        
        if (empty($apiKey)) {
            return null; // Silent fallback jika API key belum di set
        }

        $contextText = $faqContext 
            ? "Gunakan informasi RESMI berikut untuk menjawab:\n[PERTANYAAN TERKAIT]: {$faqContext->question}\n[JAWABAN RESMI]: {$faqContext->answer}"
            : "Tidak ada data spesifik di database. Jika pertanyaan umum, jawablah dengan sopan. Jika pertanyaan di luar konteks layanan RS, arahkan kembali dengan halus.";

        $locale = \Illuminate\Support\Facades\App::getLocale();
        $languageInstruction = $locale === 'en' 
            ? "CRITICAL: You MUST answer strictly in English language." 
            : "CRITICAL: You MUST answer strictly in Indonesian language (Bahasa Indonesia).";

        $systemPrompt = "Anda adalah Asisten Virtual resmi dari Rumah Sakit Khusus Bedah Ropanasuri (RSKB Ropanasuri). 
Tugas Utama Anda:
1. Menjawab pertanyaan pengguna dengan sangat ramah, empatik, dan profesional layaknya customer service RS yang handal.
2. ANDA HANYA BOLEH memberikan informasi yang berkaitan dengan ruang lingkup RSK Bedah Ropanasuri. Jika pertanyaan berada di luar konteks rumah sakit, tolak dengan sopan.
3. Jika pengguna mencari atau meminta informasi umum tentang Ropanasuri, Anda HARUS mengarahkan mereka untuk melihat informasi lebih lengkap di website resmi rumah sakit: http://ropanasuri.com/.
4. Jawablah berdasarkan CONTEXT RESMI yang diberikan. Jangan mengarang informasi seperti jadwal, nama dokter, atau biaya jika tidak tertulis di CONTEXT.
5. ATURAN MUTLAK HUKUM MEDIS: Anda TIDAK BOLEH memberikan diagnosa penyakit, merekomendasikan/meresepkan obat, atau menyebutkan estimasi biaya tindakan medis secara spesifik kecuali ada di CONTEXT. Sarankan pasien untuk berkonsultasi langsung ke rumah sakit.
6. {$languageInstruction}
7. Jika pengguna bertanya tentang siapa pencipta Anda, Anda HARUS menjawab dengan santun bahwa Anda diciptakan secara khusus oleh Bapak Teddi Takejo Saogok (IT RSKB Ropanasuri).

CONTEXT RESMI RS ROPANASURI:
- Website Resmi: http://ropanasuri.com/ (Berikan tautan ini untuk info umum Ropanasuri).
- Jadwal Dokter Lengkap & Realtime: https://antrian.ropanasuri.com/informasi/jadwal-dokter (Berikan tautan ini jika ditanya tentang jadwal dokter).
{$contextText}";

        try {
            $response = Http::withToken($apiKey)
                ->post("https://api.groq.com/openai/v1/chat/completions", [
                    'model' => 'openai/gpt-oss-20b',
                    'messages' => [
                        [
                            'role' => 'system',
                            'content' => $systemPrompt
                        ],
                        [
                            'role' => 'user',
                            'content' => $question
                        ]
                    ],
                    'temperature' => 0.4, // Cukup rendah agar jawaban tetap faktual dan konsisten
                    'max_tokens' => 800,
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return $data['choices'][0]['message']['content'] ?? null;
            }

            Log::error('Groq API Error: ' . $response->body());
            return null;
        } catch (\Exception $e) {
            Log::error('Groq Exception: ' . $e->getMessage());
            return null;
        }
    }
}