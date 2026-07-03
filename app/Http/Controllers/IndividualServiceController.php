<?php

namespace App\Http\Controllers;

use App\Models\IndividualService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreIndividualServiceRequest;
use App\Http\Requests\UpdateIndividualServiceRequest;
use App\Services\WhatsAppNotificationService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\JpegEncoder;

class IndividualServiceController extends Controller
{
    protected $whatsappService;

    public function __construct(WhatsAppNotificationService $whatsappService)
    {
        $this->middleware('auth')->except(['index', 'show', 'order']);
        $this->whatsappService = $whatsappService;
    }

    // Public methods
    public function index()
    {
        $services = IndividualService::active()
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();
        
        $featuredServices = IndividualService::active()
            ->featured()
            ->orderBy('sort_order')
            ->limit(3)
            ->get();
        
        return view('individual-services.index', compact('services', 'featuredServices'));
    }

    public function show($slug)
    {
        $service = IndividualService::where('slug', $slug)->active()->firstOrFail();
        $relatedServices = IndividualService::active()
            ->where('id', '!=', $service->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();
        
        return view('individual-services.show', compact('service', 'relatedServices'));
    }

    public function order(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'message' => 'nullable|string',
        ]);

        $service = IndividualService::findOrFail($id);
        
        // Format WhatsApp message
        $whatsappMessage = $this->whatsappService->formatOrderMessage($service, $request);
        
        // Redirect to WhatsApp
        $phoneNumber = '628116600013'; // Ganti dengan nomor WhatsApp rumah sakit
        $url = $this->whatsappService->generateUrl($phoneNumber, $whatsappMessage);
        
        return redirect($url);
    }



    // Admin methods
    public function adminIndex()
    {
        $services = IndividualService::orderBy('sort_order')->get();
        return view('admin.individual-services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.individual-services.create');
    }

    public function store(StoreIndividualServiceRequest $request)
    {

        try {
            $service = new IndividualService();
            $service->name = $request->name;
            $service->slug = Str::slug($request->name);
            $service->description = $request->description;
            $service->benefits = $request->benefits;
            $service->features = $request->features;
            $service->price = $request->price;
            $service->discount_price = $request->discount_price;
            $service->duration_days = $request->duration_days;
            $service->icon = $request->icon;
            $service->status = $request->status ?? 'active';
            $service->is_featured = $request->has('is_featured');
            $service->sort_order = $request->sort_order ?? 0;
            $service->whatsapp_message = $request->whatsapp_message;

            if ($request->hasFile('image')) {
                $manager = new ImageManager(new Driver());
                $imageFile = $manager->decode($request->file('image'));
                $imageFile->scaleDown(width: 800);
                
                $filename = uniqid() . '.jpg';
                $path = 'individual-services/' . $filename;
                Storage::disk('public')->put($path, (string) $imageFile->encode(new JpegEncoder(85)));
                
                $service->image = $path;
            }

            $service->save();

            return redirect()->route('admin.individual-services.index')
                ->with('success', 'Paket layanan berhasil ditambahkan.');

        } catch (\Exception $e) {
            Log::error('Error creating individual service: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function edit($id)
    {
        $service = IndividualService::findOrFail($id);
        return view('admin.individual-services.edit', compact('service'));
    }

    public function update(UpdateIndividualServiceRequest $request, $id)
    {

        try {
            $service = IndividualService::findOrFail($id);
            $service->name = $request->name;
            $service->slug = Str::slug($request->name);
            $service->description = $request->description;
            $service->benefits = $request->benefits;
            $service->features = $request->features;
            $service->price = $request->price;
            $service->discount_price = $request->discount_price;
            $service->duration_days = $request->duration_days;
            $service->icon = $request->icon;
            $service->status = $request->status ?? 'active';
            $service->is_featured = $request->has('is_featured');
            $service->sort_order = $request->sort_order ?? 0;
            $service->whatsapp_message = $request->whatsapp_message;

            if ($request->hasFile('image')) {
                if ($service->image) {
                    Storage::disk('public')->delete($service->image);
                }
                
                $manager = new ImageManager(new Driver());
                $imageFile = $manager->decode($request->file('image'));
                $imageFile->scaleDown(width: 800);
                
                $filename = uniqid() . '.jpg';
                $path = 'individual-services/' . $filename;
                Storage::disk('public')->put($path, (string) $imageFile->encode(new JpegEncoder(85)));
                
                $service->image = $path;
            }

            $service->save();

            return redirect()->route('admin.individual-services.index')
                ->with('success', 'Paket layanan berhasil diperbarui.');

        } catch (\Exception $e) {
            Log::error('Error updating individual service: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $service = IndividualService::findOrFail($id);
            
            // Delete image
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            
            $service->delete();

            return redirect()->route('admin.individual-services.index')
                ->with('success', 'Paket layanan berhasil dihapus.');

        } catch (\Exception $e) {
            Log::error('Error deleting individual service: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        try {
            $service = IndividualService::findOrFail($id);
            $service->status = $service->status === 'active' ? 'inactive' : 'active';
            $service->save();

            $status = $service->status === 'active' ? 'diaktifkan' : 'dinonaktifkan';
            return redirect()->back()->with('success', 'Paket layanan berhasil ' . $status . '.');

        } catch (\Exception $e) {
            Log::error('Error toggling service status: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}