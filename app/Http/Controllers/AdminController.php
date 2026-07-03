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
        $totalArtikel = Artikel::where('is_published', true)->count();
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
        
        return view('admin.dashboard', compact(
            'totalFaq',
            'totalArtikel', 
            'totalChat',
            'totalKeyword',
            'faqPopuler',
            'artikelTerbaru',
            'chatHariIni',
            'pertanyaanTidakDitemukan'
        ));
    }
}