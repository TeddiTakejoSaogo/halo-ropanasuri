<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminFaqController;
use App\Http\Controllers\AdminArtikelController;
use App\Http\Controllers\Admin\AdminChatController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// ===== PUBLIC ROUTES =====
Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['id', 'en'])) {
        session()->put('locale', $locale);
    }
    return redirect()->back();
})->name('lang.switch');

Route::get('/', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat/ask', [ChatController::class, 'ask'])->name('chat.ask');
Route::get('/artikel/{slug}', [AdminArtikelController::class, 'show'])->name('artikel.show');

// ===== LOGIN ROUTES (GUEST ONLY) =====
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

// ===== LOGOUT ROUTE =====
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// ===== ADMIN ROUTES (PROTECTED) =====
Route::middleware(['auth'])->group(function () {
    
    // === DASHBOARD ===
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // === CHAT MANAGEMENT ===
    Route::prefix('admin/chat')->name('admin.chat.')->group(function () {
        Route::get('/logs', [AdminChatController::class, 'logs'])->name('logs');
        Route::get('/unanswered', [AdminChatController::class, 'unanswered'])->name('unanswered');
        Route::post('/add-to-faq', [AdminChatController::class, 'addToFaq'])->name('add-to-faq');
        Route::get('/export', [AdminChatController::class, 'export'])->name('export');
        Route::get('/{id}', [AdminChatController::class, 'show'])->name('show');
        Route::delete('/{id}', [AdminChatController::class, 'destroy'])->name('destroy');
    });
    
    // === FAQ MANAGEMENT - LENGKAP DENGAN SEMUA ROUTE ===
    Route::prefix('admin/faq')->name('admin.faq.')->group(function () {
        // Fitur Tambahan (Static routes must be before dynamic routes)
        Route::delete('/bulk-destroy', [AdminFaqController::class, 'bulkDestroy'])->name('bulk-destroy');

        // CRUD Utama
        Route::get('/', [AdminFaqController::class, 'index'])->name('index');
        Route::get('/create', [AdminFaqController::class, 'create'])->name('create');
        Route::post('/', [AdminFaqController::class, 'store'])->name('store');
        
        // Dynamic Routes
        Route::get('/{faq}/edit', [AdminFaqController::class, 'edit'])->name('edit');
        Route::put('/{faq}', [AdminFaqController::class, 'update'])->name('update');
        Route::delete('/{faq}', [AdminFaqController::class, 'destroy'])->name('destroy');
        Route::post('/{faq}/toggle-status', [AdminFaqController::class, 'toggleStatus'])->name('toggle-status');
        Route::post('/{faq}/duplicate', [AdminFaqController::class, 'duplicate'])->name('duplicate');
    });
    
    // === ARTIKEL MANAGEMENT - LENGKAP DENGAN SEMUA ROUTE ===
    Route::prefix('admin/artikel')->name('admin.artikel.')->group(function () {
        // Fitur Tambahan (Static routes must be before dynamic routes)
        Route::delete('/bulk-destroy', [AdminArtikelController::class, 'bulkDestroy'])->name('bulk-destroy');
        Route::get('/kategori', [AdminArtikelController::class, 'categories'])->name('categories');
        Route::post('/upload-image', [AdminArtikelController::class, 'uploadImage'])->name('upload-image');

        // CRUD Utama
        Route::get('/', [AdminArtikelController::class, 'index'])->name('index');
        Route::get('/create', [AdminArtikelController::class, 'create'])->name('create');
        Route::post('/', [AdminArtikelController::class, 'store'])->name('store');
        
        // Dynamic Routes
        Route::get('/{artikel}/edit', [AdminArtikelController::class, 'edit'])->name('edit');
        Route::put('/{artikel}', [AdminArtikelController::class, 'update'])->name('update');
        Route::delete('/{artikel}', [AdminArtikelController::class, 'destroy'])->name('destroy');
        Route::post('/{artikel}/toggle-publish', [AdminArtikelController::class, 'togglePublish'])->name('toggle-publish');
        Route::post('/{artikel}/duplicate', [AdminArtikelController::class, 'duplicate'])->name('duplicate');
    });
});