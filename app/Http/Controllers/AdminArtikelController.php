<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class AdminArtikelController extends Controller
{
    /**
     * Display a listing of the articles.
     */
    public function index(Request $request)
    {
        $query = Artikel::query();
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('konten', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }
        
        // Filter by category
        if ($request->filled('category')) {
            $query->where('kategori', $request->category);
        }
        
        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            }
        }
        
        // Sort
        $sort = $request->get('sort', 'latest');
        if ($sort === 'latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($sort === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($sort === 'popular') {
            $query->orderBy('dilihat', 'desc');
        } elseif ($sort === 'updated') {
            $query->orderBy('updated_at', 'desc');
        }
        
        $artikels = $query->paginate(12)->withQueryString();
        
        // Get all categories
        $categories = Artikel::select('kategori')
                            ->whereNotNull('kategori')
                            ->distinct()
                            ->orderBy('kategori')
                            ->pluck('kategori');
        
        return view('admin.artikel.index', compact('artikels', 'categories'));
    }

    /**
     * Show the form for creating a new article.
     */
    public function create()
    {
        return view('admin.artikel.create');
    }

    /**
     * Store a newly created article in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'excerpt' => 'nullable|string|max:300',
            'kategori' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_published' => 'boolean'
        ]);

        DB::beginTransaction();
        try {
            $data = $request->all();
            
            // SANITASI HTML - HAPUS SCRIPT JAHAT
            $data['konten'] = $this->sanitizeHtml($request->konten);
            
            // Generate slug
            $slug = Str::slug($request->judul);
            $count = 1;
            while (Artikel::where('slug', $slug)->exists()) {
                $slug = Str::slug($request->judul) . '-' . $count;
                $count++;
            }
            $data['slug'] = $slug;
            
            // Upload gambar dengan nama aman
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $data['gambar'] = $file->storeAs('artikel', $fileName, 'public');
            }
            
            // Set published_at
            if ($request->has('is_published')) {
                $data['published_at'] = now();
            }
            
            $data['is_published'] = $request->has('is_published');
            $data['dilihat'] = 0;
            
            Artikel::create($data);
            
            DB::commit();
            
            return redirect()->route('admin.artikel.index')
                ->with('success', 'Artikel berhasil ditambahkan');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menambahkan artikel: ' . $e->getMessage())
                         ->withInput();
        }
    }

    /**
     * Show the form for editing the specified article.
     */
    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.edit', compact('artikel'));
    }
    /**
     * Remove the specified article from storage.
     */
    public function destroy(Artikel $artikel)
    {
        try {
            // Delete image
            if ($artikel->gambar) {
                Storage::disk('public')->delete($artikel->gambar);
            }
            
            $artikel->delete();
            
            return redirect()->route('admin.artikel.index')
                ->with('success', 'Artikel berhasil dihapus');
                
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus artikel: ' . $e->getMessage());
        }
    }

    /**
     * Toggle publish status.
     */
    public function togglePublish(Artikel $artikel)
    {
        $artikel->is_published = !$artikel->is_published;
        
        if ($artikel->is_published && !$artikel->published_at) {
            $artikel->published_at = now();
        }
        
        $artikel->save();
        
        $status = $artikel->is_published ? 'dipublikasikan' : 'diarsipkan';
        
        return redirect()->back()
            ->with('success', "Artikel berhasil {$status}");
    }

    /**
     * Display the specified article (public view).
     */
    public function show($slug)
    {
        $artikel = Artikel::where('slug', $slug)
                         ->where('is_published', true)
                         ->firstOrFail();
        
        // Increment view count
        $artikel->increment('dilihat');
        
        $artikelLainnya = Artikel::where('id', '!=', $artikel->id)
                               ->where('is_published', true)
                               ->latest()
                               ->limit(3)
                               ->get();
        
        return view('artikel.show', compact('artikel', 'artikelLainnya'));
    }

    /**
     * Duplicate article.
     */
    public function duplicate(Artikel $artikel)
    {
        DB::beginTransaction();
        try {
            $newGambar = null;
            if ($artikel->gambar && Storage::disk('public')->exists($artikel->gambar)) {
                $extension = pathinfo($artikel->gambar, PATHINFO_EXTENSION);
                $newGambar = 'artikel/' . time() . '_' . Str::random(10) . '.' . $extension;
                Storage::disk('public')->copy($artikel->gambar, $newGambar);
            }

            $newArtikel = Artikel::create([
                'judul' => $artikel->judul . ' (Copy)',
                'slug' => $artikel->slug . '-copy-' . uniqid(),
                'konten' => $artikel->konten,
                'excerpt' => $artikel->excerpt,
                'kategori' => $artikel->kategori,
                'gambar' => $newGambar,
                'is_published' => false,
                'dilihat' => 0,
                'published_at' => null
            ]);
            
            DB::commit();
            
            return redirect()->route('admin.artikel.edit', $newArtikel)
                ->with('success', 'Artikel berhasil diduplikasi. Silakan edit sesuai kebutuhan.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menduplikasi artikel: ' . $e->getMessage());
        }
    }

    /**
     * Manage categories.
     */
    public function categories()
    {
        $categories = Artikel::select('kategori')
                            ->whereNotNull('kategori')
                            ->selectRaw('count(*) as total')
                            ->groupBy('kategori')
                            ->orderBy('total', 'desc')
                            ->get();
        
        return view('admin.artikel.categories', compact('categories'));
    }

    /**
     * Bulk delete articles.
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:artikels,id'
        ]);
        
        DB::beginTransaction();
        try {
            $artikels = Artikel::whereIn('id', $request->ids)->get();
            
            foreach ($artikels as $artikel) {
                if ($artikel->gambar) {
                    Storage::disk('public')->delete($artikel->gambar);
                }
            }
            
            Artikel::whereIn('id', $request->ids)->delete();
            
            DB::commit();
            
            return redirect()->route('admin.artikel.index')
                ->with('success', count($request->ids) . ' artikel berhasil dihapus');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus artikel: ' . $e->getMessage());
        }
    }

    /**
     * Handle CKEditor Image Upload
     */
    public function uploadImage(Request $request)
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = time() . '_' . Str::slug($fileName) . '.' . $extension;
    
            $request->file('upload')->storeAs('artikel/konten', $fileName, 'public');
    
            $url = asset('storage/artikel/konten/' . $fileName);
            
            return response()->json([
                'fileName' => $fileName,
                'uploaded' => 1,
                'url' => $url
            ]);
        }
    }
    
    private function sanitizeHtml($dirtyHtml)
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.Allowed', 
            'p,br,strong,em,u,ol,ul,li,blockquote,h2,h3,h4,h5,pre,' .
            'a[href|target],img[src|alt|width|height],table,thead,tbody,tr,td,th,' .
            'span[style],div[style]'
        );
        $config->set('HTML.TargetBlank', true);
        $config->set('Attr.AllowedFrameTargets', ['_blank', '_self']);
        $config->set('CSS.AllowedProperties', 'color,background-color,font-size,font-family,text-align,margin,padding');
        $config->set('AutoFormat.RemoveEmpty', true);
        $config->set('AutoFormat.RemoveEmpty.RemoveNbsp', true);
        
        $purifier = new HTMLPurifier($config);
        return $purifier->purify($dirtyHtml);
    }

    /**
    * Update the specified article in storage.
    */
     public function update(Request $request, Artikel $artikel)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'konten' => 'required|string',
            'excerpt' => 'nullable|string|max:300',
            'kategori' => 'nullable|string|max:100',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'is_published' => 'boolean'
        ]);

        DB::beginTransaction();
        try {
            $data = $request->all();
            
            // SANITASI HTML - HAPUS SCRIPT JAHAT
            $data['konten'] = $this->sanitizeHtml($request->konten);
            
            // Update slug if title changed
            if ($artikel->judul !== $request->judul) {
                $slug = Str::slug($request->judul);
                $count = 1;
                while (Artikel::where('slug', $slug)->where('id', '!=', $artikel->id)->exists()) {
                    $slug = Str::slug($request->judul) . '-' . $count;
                    $count++;
                }
                $data['slug'] = $slug;
            }
            
            // Upload new image with safe filename
            if ($request->hasFile('gambar')) {
                // Delete old image
                if ($artikel->gambar) {
                    Storage::disk('public')->delete($artikel->gambar);
                }
                
                $file = $request->file('gambar');
                $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $data['gambar'] = $file->storeAs('artikel', $fileName, 'public');
            }
            
            // Set published_at if just published
            if ($request->has('is_published') && !$artikel->is_published) {
                $data['published_at'] = now();
            }
            
            $data['is_published'] = $request->has('is_published');
            
            $artikel->update($data);
            
            DB::commit();
            
            return redirect()->route('admin.artikel.index')
                ->with('success', 'Artikel berhasil diperbarui');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memperbarui artikel: ' . $e->getMessage())
                         ->withInput();
        }
    }
}