<?php

namespace App\Http\Controllers;

use App\Models\HomecarePackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class HomecareController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    // Public: List semua paket homecare
    public function index()
    {
        $packages = HomecarePackage::active()
            ->orderBy('order')
            ->get();

        return view('homecare.index', compact('packages'));
    }

    // Public: Detail paket homecare
    public function show($slug)
    {
        $package = HomecarePackage::where('slug', $slug)
            ->active()
            ->firstOrFail();

        $otherPackages = HomecarePackage::where('id', '!=', $package->id)
            ->active()
            ->orderBy('order')
            ->limit(3)
            ->get();

        return view('homecare.show', compact('package', 'otherPackages'));
    }

    // Admin: List paket homecare
    public function adminIndex()
    {
        $packages = HomecarePackage::orderBy('order')->get();
        return view('admin.homecare.index', compact('packages'));
    }

    // Admin: Form create
    public function create()
    {
        return view('admin.homecare.create');
    }

    // Admin: Store new package
    public function store(Request $request)
    {
        Log::info('Storing homecare package', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'preparation' => 'nullable|string',
            'procedure' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'duration' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|string',
            'whatsapp_message' => 'nullable|string',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            $package = new HomecarePackage();
            $package->name = $request->name;
            $package->description = $request->description;
            $package->preparation = $request->preparation;
            $package->procedure = $request->procedure;
            $package->price = $request->price;
            $package->duration = $request->duration;
            $package->features = $this->parseFeatures($request->features);
            $package->whatsapp_message = $request->whatsapp_message;
            $package->order = $request->order ?? 0;
            $package->status = $request->status;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('homecare', 'public');
                $package->image = $imagePath;
            }

            $package->save();

            return redirect()->route('admin.homecare.index')
                ->with('success', 'Paket homecare berhasil ditambahkan.');

        } catch (\Exception $e) {
            Log::error('Error storing homecare package: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Admin: Form edit
    public function edit($id)
    {
        $package = HomecarePackage::findOrFail($id);
        return view('admin.homecare.edit', compact('package'));
    }

    // Admin: Update package
    public function update(Request $request, $id)
    {
        Log::info('Updating homecare package', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'preparation' => 'nullable|string',
            'procedure' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'duration' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'features' => 'nullable|string',
            'whatsapp_message' => 'nullable|string',
            'order' => 'nullable|integer',
            'status' => 'required|in:active,inactive'
        ]);

        try {
            $package = HomecarePackage::findOrFail($id);
            $package->name = $request->name;
            $package->description = $request->description;
            $package->preparation = $request->preparation;
            $package->procedure = $request->procedure;
            $package->price = $request->price;
            $package->duration = $request->duration;
            $package->features = $this->parseFeatures($request->features);
            $package->whatsapp_message = $request->whatsapp_message;
            $package->order = $request->order ?? 0;
            $package->status = $request->status;

            if ($request->hasFile('image')) {
                // Delete old image
                if ($package->image) {
                    Storage::disk('public')->delete($package->image);
                }
                $imagePath = $request->file('image')->store('homecare', 'public');
                $package->image = $imagePath;
            }

            $package->save();

            return redirect()->route('admin.homecare.index')
                ->with('success', 'Paket homecare berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Error updating homecare package: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    // Admin: Delete package
    public function destroy($id)
    {
        try {
            $package = HomecarePackage::findOrFail($id);
            
            // Delete image if exists
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }
            
            $package->delete();

            return redirect()->route('admin.homecare.index')
                ->with('success', 'Paket homecare berhasil dihapus.');

        } catch (\Exception $e) {
            Log::error('Error deleting homecare package: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    // Helper: Parse features from text to array
    private function parseFeatures($features)
    {
        if (empty($features)) {
            return null;
        }

        $featuresArray = array_filter(
            explode("\n", $features),
            function($item) {
                return !empty(trim($item));
            }
        );

        return array_map('trim', $featuresArray);
    }
}