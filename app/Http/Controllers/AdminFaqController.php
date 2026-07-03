<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Keyword;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AdminFaqController extends Controller
{
    /**
     * Display a listing of the FAQ.
     */
    public function index(Request $request)
    {
        $query = Faq::withCount('keywords')->with('keywords');
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('question', 'like', "%{$search}%")
                  ->orWhere('answer', 'like', "%{$search}%")
                  ->orWhereHas('keywords', function($kw) use ($search) {
                      $kw->where('keyword', 'like', "%{$search}%");
                  });
            });
        }
        
        // Filter by category
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }
        
        // Sort
        $sort = $request->get('sort', 'latest');
        if ($sort === 'popular') {
            $query->orderBy('hit_count', 'desc');
        } elseif ($sort === 'latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        }
        
        $faqs = $query->paginate(15)->withQueryString();
        
        // Get all categories for filter dropdown
        $categories = Faq::select('category')
                        ->whereNotNull('category')
                        ->distinct()
                        ->orderBy('category')
                        ->pluck('category');
        
        return view('admin.faq.index', compact('faqs', 'categories'));
    }

    /**
     * Show the form for creating a new FAQ.
     */
    public function create(Request $request)
    {
        $defaultQuestion = $request->get('question', '');
        return view('admin.faq.create', compact('defaultQuestion'));
    }

    /**
     * Store a newly created FAQ in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
            'keywords' => 'required|string',
            'is_active' => 'boolean'
        ]);

        DB::beginTransaction();
        try {
            // Simpan FAQ
            $faq = Faq::create([
                'question' => $request->question,
                'answer' => $request->answer,
                'category' => $request->category ?: 'Umum',
                'is_active' => $request->has('is_active'),
                'hit_count' => 0
            ]);

            // Simpan keywords
            $keywords = array_map('trim', explode(',', $request->keywords));
            $keywords = array_filter($keywords);
            
            foreach ($keywords as $keyword) {
                if (!empty($keyword)) {
                    $faq->keywords()->create([
                        'keyword' => Str::lower($keyword),
                        'weight' => 1
                    ]);
                }
            }
            
            DB::commit();
            
            return redirect()->route('admin.faq.index')
                ->with('success', 'FAQ berhasil ditambahkan');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menambahkan FAQ: ' . $e->getMessage())
                         ->withInput();
        }
    }

    /**
     * Show the form for editing the specified FAQ.
     */
    public function edit(Faq $faq)
    {
        $faq->load('keywords');
        $keywordsString = $faq->keywords->pluck('keyword')->implode(', ');
        
        return view('admin.faq.edit', compact('faq', 'keywordsString'));
    }

    /**
     * Update the specified FAQ in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'category' => 'nullable|string|max:100',
            'keywords' => 'required|string',
            'is_active' => 'boolean'
        ]);

        DB::beginTransaction();
        try {
            // Update FAQ
            $faq->update([
                'question' => $request->question,
                'answer' => $request->answer,
                'category' => $request->category ?: 'Umum',
                'is_active' => $request->has('is_active')
            ]);

            // Hapus keywords lama
            $faq->keywords()->delete();
            
            // Buat keywords baru
            $keywords = array_map('trim', explode(',', $request->keywords));
            $keywords = array_filter($keywords);
            
            foreach ($keywords as $keyword) {
                if (!empty($keyword)) {
                    $faq->keywords()->create([
                        'keyword' => Str::lower($keyword),
                        'weight' => 1
                    ]);
                }
            }
            
            DB::commit();
            
            return redirect()->route('admin.faq.index')
                ->with('success', 'FAQ berhasil diperbarui');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui FAQ: ' . $e->getMessage())
                         ->withInput();
        }
    }

    /**
     * Remove the specified FAQ from storage.
     */
    public function destroy(Faq $faq)
    {
        try {
            // Keywords akan otomatis terhapus (cascade)
            $faq->delete();
            
            return redirect()->route('admin.faq.index')
                ->with('success', 'FAQ berhasil dihapus');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus FAQ: ' . $e->getMessage());
        }
    }
    
    /**
     * Toggle FAQ active status.
     */
    public function toggleStatus(Faq $faq)
    {
        $faq->is_active = !$faq->is_active;
        $faq->save();
        
        $status = $faq->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->back()
            ->with('success', "FAQ berhasil {$status}");
    }
    
    /**
     * Duplicate FAQ.
     */
    public function duplicate(Faq $faq)
    {
        DB::beginTransaction();
        try {
            $newFaq = Faq::create([
                'question' => $faq->question . ' (Copy)',
                'answer' => $faq->answer,
                'category' => $faq->category,
                'is_active' => false,
                'hit_count' => 0
            ]);
            
            // Duplicate keywords
            foreach ($faq->keywords as $keyword) {
                $newFaq->keywords()->create([
                    'keyword' => $keyword->keyword,
                    'weight' => $keyword->weight
                ]);
            }
            
            DB::commit();
            
            return redirect()->route('admin.faq.edit', $newFaq)
                ->with('success', 'FAQ berhasil diduplikasi. Silakan edit sesuai kebutuhan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menduplikasi FAQ: ' . $e->getMessage());
        }
    }
    
    /**
     * Bulk delete FAQs.
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:faqs,id'
        ]);
        
        try {
            Faq::whereIn('id', $request->ids)->delete();
            
            return redirect()->route('admin.faq.index')
                ->with('success', count($request->ids) . ' FAQ berhasil dihapus');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus FAQ: ' . $e->getMessage());
        }
    }
}