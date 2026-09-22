<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Artikel;
use App\Models\ChatLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistik Umum
        $totalFaq = Faq::count();
        $totalArtikel = Artikel::count();
        $artikelPublished = Artikel::where('is_published', true)->count();
        $artikelDraft = Artikel::where('is_published', false)->count();
        
        $totalChat = ChatLog::count();
        $totalKeyword = DB::table('keywords')->count();
        
        // FAQ Terpopuler
        $faqPopuler = Faq::orderBy('hit_count', 'desc')->limit(5)->get();
        
        // Artikel Terbaru
        $artikelTerbaru = Artikel::where('is_published', true)
                                ->orderBy('published_at', 'desc')
                                ->limit(5)
                                ->get();
        
        // Statistik Chat Hari Ini
        $chatHariIni = ChatLog::whereDate('created_at', today())->count();
        
        // Pertanyaan yang Tidak Ditemukan
        $pertanyaanTidakDitemukan = ChatLog::where('status', 'not_found')
                                          ->orWhere('status', 'empty')
                                          ->orderBy('created_at', 'desc')
                                          ->limit(10)
                                          ->get();
                                          
        // Chat Terbaru
        $chatTerbaru = ChatLog::orderBy('created_at', 'desc')->limit(5)->get();
        
        // Statistik Chat Mingguan (7 Hari)
        $weeklyStats = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            
            $found = ChatLog::whereDate('created_at', $date)
                ->whereIn('status', ['found', 'found_ai', 'emergency', 'restricted'])
                ->count();
            
            $notFound = ChatLog::whereDate('created_at', $date)
                ->whereIn('status', ['not_found', 'empty'])
                ->count();
                
            $totalDay = ChatLog::whereDate('created_at', $date)->count();
            
            $weeklyStats[] = [
                'date' => $date->translatedFormat('d M'),
                'found_percentage' => $totalDay > 0 ? round(($found / $totalDay) * 100) : 0,
                'not_found_percentage' => $totalDay > 0 ? round(($notFound / $totalDay) * 100) : 0,
                'total' => $totalDay,
                'found' => $found,
                'not_found' => $notFound
            ];
        }
        
        return view('admin.dashboard', compact(
            'totalFaq',
            'totalArtikel', 
            'artikelPublished',
            'artikelDraft',
            'totalChat',
            'totalKeyword',
            'faqPopuler',
            'artikelTerbaru',
            'chatHariIni',
            'pertanyaanTidakDitemukan',
            'chatTerbaru',
            'weeklyStats'
        ));
    }
}