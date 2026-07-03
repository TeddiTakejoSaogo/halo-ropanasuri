<?php

namespace App\Http\Controllers;

use App\Services\AiChatService;
use App\Models\ChatLog;
use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ChatController extends Controller
{
    protected $aiService;

    public function __construct(AiChatService $aiService)
    {
        $this->aiService = $aiService;
    }

    public function index()
    {
        // Set application locale from session
        App::setLocale(session()->get('locale', 'id'));

        // AMBIL ARTIKEL DARI DATABASE
        $artikels = Artikel::where('is_published', true)
                          ->orderBy('created_at', 'desc')
                          ->limit(5)
                          ->get();
        
        return view('chat.index', compact('artikels'));
    }

    public function ask(Request $request)
    {
        // Set application locale from session
        App::setLocale(session()->get('locale', 'id'));

        $request->validate([
            'question' => 'required|string|max:500'
        ]);

        $question = $request->question;
        
        // Proses dengan AI Service
        $result = $this->aiService->getAnswer($question);
        
        // Simpan log chat
        ChatLog::create([
            'session_id' => session()->getId(),
            'question' => $question,
            'answer' => $result['answer'],
            'faq_id' => $result['faq']?->id,
            'status' => $result['status']
        ]);

        return response()->json([
            'answer' => $result['answer'],
            'status' => $result['status'],
            'follow_ups' => $result['follow_ups'] ?? []
        ]);
    }
}