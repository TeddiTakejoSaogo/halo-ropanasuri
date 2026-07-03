<?php

namespace App\Http\Controllers;

use App\Models\HomecarePackage;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHomecareRequest;
use App\Http\Requests\UpdateHomecareRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;

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
    public function store(StoreHomecareRequest $request)
    {
        Log::info('Storing homecare package', $request->all());

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
                $manager = new ImageManager(new Driver());
                $imageFile = $manager->decode($request->file('image'));
                $imageFile->scaleDown(width: 800);
                
                $filename = uniqid() . '.jpg';
                $path = 'homecare/' . $filename;
                Storage::disk('public')->put($path, (string) $imageFile->encode(new JpegEncoder(85)));
                
                $package->image = $path;
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
    public function update(UpdateHomecareRequest $request, $id)
    {
        Log::info('Updating homecare package', $request->all());

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
                if ($package->image) {
                    Storage::disk('public')->delete($package->image);
                }
                
                $manager = new ImageManager(new Driver());
                $imageFile = $manager->decode($request->file('image'));
                $imageFile->scaleDown(width: 800);
                
                $filename = uniqid() . '.jpg';
                $path = 'homecare/' . $filename;
                Storage::disk('public')->put($path, (string) $imageFile->encode(new JpegEncoder(85)));
                
                $package->image = $path;
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