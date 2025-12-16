<?php

namespace App\Http\Controllers;

use App\Models\IndividualService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class IndividualServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'order']);
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
        $whatsappMessage = $this->formatWhatsAppMessage($service, $request);
        
        // Redirect to WhatsApp
        $phoneNumber = '628116600013'; // Ganti dengan nomor WhatsApp rumah sakit
        $url = "https://wa.me/{$phoneNumber}?text=" . urlencode($whatsappMessage);
        
        return redirect($url);
    }

    private function formatWhatsAppMessage($service, $request)
    {
        $defaultMessage = "Halo, saya ingin memesan paket layanan:\n\n";
        $defaultMessage .= "📋 *{$service->name}*\n";
        $defaultMessage .= "💵 Harga: {$service->formatted_price}\n";
        
        if ($service->discount_price) {
            $defaultMessage .= "💵 Harga Diskon: {$service->formatted_discount_price}\n";
            $defaultMessage .= "🎁 Diskon: {$service->discount_percentage}%\n";
        }
        
        $defaultMessage .= "\n📝 *Data Pemesan:*\n";
        $defaultMessage .= "👤 Nama: {$request->name}\n";
        $defaultMessage .= "📞 Telepon: {$request->phone}\n";
        $defaultMessage .= "📧 Email: {$request->email}\n";
        
        if ($request->message) {
            $defaultMessage .= "\n💬 Pesan Tambahan:\n{$request->message}\n";
        }
        
        $defaultMessage .= "\n_Saya memesan melalui website RS Sehat Sentosa_";
        
        return $defaultMessage;
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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'benefits' => 'nullable|string',
            'features' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'duration_days' => 'nullable|integer|min:1',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'whatsapp_message' => 'nullable|string',
        ]);

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
                $imagePath = $request->file('image')->store('individual-services', 'public');
                $service->image = $imagePath;
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

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'benefits' => 'nullable|string',
            'features' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'duration_days' => 'nullable|integer|min:1',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'whatsapp_message' => 'nullable|string',
        ]);

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
                // Delete old image
                if ($service->image) {
                    Storage::disk('public')->delete($service->image);
                }
                $imagePath = $request->file('image')->store('individual-services', 'public');
                $service->image = $imagePath;
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