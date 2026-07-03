<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreContactMessageRequest;
use Illuminate\Support\Facades\Log;

class ContactMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['store']);
    }

    /**
     * Store a newly created resource in storage (Public)
     */
    public function store(StoreContactMessageRequest $request)
    {

        try {
            ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'message' => $request->message,
                'status' => 'unread',
            ]);

            Log::info('New contact message from: ' . $request->email);

            return response()->json([
                'success' => true,
                'message' => 'Pesan Anda berhasil dikirim! Kami akan menghubungi Anda dalam 1x24 jam.'
            ]);

        } catch (\Exception $e) {
            Log::error('Error storing contact message: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan. Silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Display a listing of the resource (Admin)
     */
    public function index(Request $request)
    {
        $query = ContactMessage::query();
        
        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('subject', 'like', '%' . $request->search . '%');
            });
        }
        
        $messages = $query->latest()->get();
        
        return view('admin.contact-messages', compact('messages'));
    }

    /**
     * Display the specified resource (Admin)
     */
    public function show($id)
    {
        $message = ContactMessage::findOrFail($id);
        
        // Mark as read when viewing
        if ($message->status == 'unread') {
            $message->update(['status' => 'read']);
        }
        
        return view('admin.contact-message-detail', compact('message'));
    }

    /**
     * Update the specified resource in storage (Admin)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:unread,read,replied',
            'admin_notes' => 'nullable|string'
        ]);

        try {
            $message = ContactMessage::findOrFail($id);
            $message->update($request->only(['status', 'admin_notes']));

            return redirect()->route('admin.contact-messages.show', $message->id)
                ->with('success', 'Status pesan berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Error updating contact message: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage (Admin)
     */
    public function destroy($id)
    {
        try {
            $message = ContactMessage::findOrFail($id);
            $message->delete();

            return redirect()->route('admin.contact-messages')
                ->with('success', 'Pesan berhasil dihapus.');

        } catch (\Exception $e) {
            Log::error('Error deleting contact message: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Mark message as replied (Admin)
     */
    public function markAsReplied($id)
    {
        try {
            $message = ContactMessage::findOrFail($id);
            $message->update(['status' => 'replied']);

            return redirect()->back()
                ->with('success', 'Pesan ditandai sebagai sudah dibalas.');

        } catch (\Exception $e) {
            Log::error('Error marking message as replied: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}