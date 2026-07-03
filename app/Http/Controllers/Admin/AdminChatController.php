<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ChatLog;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminChatController extends Controller
{
    /**
     * Menampilkan riwayat chat
     */
    public function logs(Request $request)
    {
        $query = ChatLog::with('faq')->latest();
        
        // Filter berdasarkan tanggal
        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }
        
        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                  ->orWhere('answer', 'like', "%{$search}%");
            });
        }
        
        $logs = $query->paginate(20)->withQueryString();
        
        // Statistik
        $stats = [
            'total_hari_ini' => ChatLog::whereDate('created_at', today())->count(),
            'tidak_ditemukan' => ChatLog::where('status', 'not_found')->count(),
            'faq_terbanyak' => Faq::orderBy('hit_count', 'desc')->first(),
        ];
        
        return view('admin.chat.logs', compact('logs', 'stats'));
    }
    
    /**
     * Menampilkan pertanyaan yang tidak terjawab
     */
    public function unanswered()
    {
        $unanswered = ChatLog::where('status', 'not_found')
                            ->orWhere('status', 'empty')
                            ->orderBy('created_at', 'desc')
                            ->paginate(30);
        
        // Group by pertanyaan similar
        $grouped = ChatLog::where('status', 'not_found')
                         ->select('question', DB::raw('count(*) as total'))
                         ->groupBy('question')
                         ->orderBy('total', 'desc')
                         ->limit(20)
                         ->get();
        
        return view('admin.chat.unanswered', compact('unanswered', 'grouped'));
    }
    
    /**
     * Menambahkan pertanyaan ke FAQ
     */
    public function addToFaq(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
            'keywords' => 'required|string'
        ]);
        
        // Simpan ke FAQ
        $faq = Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
            'category' => $request->category ?? 'Umum',
            'hit_count' => 0,
            'is_active' => true
        ]);
        
        // Simpan keywords
        $keywords = array_map('trim', explode(',', $request->keywords));
        foreach ($keywords as $keyword) {
            if (!empty($keyword)) {
                $faq->keywords()->create([
                    'keyword' => strtolower($keyword),
                    'weight' => 1
                ]);
            }
        }
        
        // Update chat logs yang sama
        if ($request->filled('update_previous')) {
            ChatLog::where('question', 'like', '%' . $request->question . '%')
                   ->where('status', 'not_found')
                   ->update([
                       'faq_id' => $faq->id,
                       'answer' => $request->answer,
                       'status' => 'found'
                   ]);
        }
        
        return redirect()->back()->with('success', 'Pertanyaan berhasil ditambahkan ke FAQ');
    }
    
    /**
     * Detail chat log
     */
    public function show($id)
    {
        $log = ChatLog::with('faq')->findOrFail($id);
        return view('admin.chat.show', compact('log'));
    }
    
    /**
     * Hapus chat log
     */
    public function destroy($id)
    {
        $log = ChatLog::findOrFail($id);
        $log->delete();
        
        return redirect()->back()->with('success', 'Riwayat chat berhasil dihapus');
    }
    
    /**
     * Export logs
     */
    public function export(Request $request)
    {
        // Logika export ke CSV/Excel
        $logs = ChatLog::latest()->limit(1000)->get();
        
        $filename = "chat-logs-" . date('Y-m-d') . ".csv";
        $handle = fopen($filename, 'w');
        
        // Header
        fputcsv($handle, ['Tanggal', 'Pertanyaan', 'Jawaban', 'Status', 'FAQ ID']);
        
        foreach ($logs as $log) {
            fputcsv($handle, [
                $log->created_at,
                $log->question,
                $log->answer,
                $log->status,
                $log->faq_id
            ]);
        }
        
        fclose($handle);
        
        return response()->download($filename)->deleteFileAfterSend(true);
    }
}