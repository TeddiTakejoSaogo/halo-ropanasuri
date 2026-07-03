<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['store', 'index']);
    }

    // Public method untuk submit testimoni
    public function store(Request $request)
    {
        // Honeypot check
        if ($request->filled('website_url')) {
            abort(403, 'Spam detected.');
        }

        $request->validate([
            'patient_name' => 'required|string|max:255',
            'patient_email' => 'required|email',
            'message' => 'required|string|min:10|max:500',
            'rating' => 'required|integer|between:1,5'
        ]);

        Testimonial::create($request->only([
            'patient_name', 
            'patient_email', 
            'message', 
            'rating'
        ]));

        return redirect()->route('testimonials')
            ->with('success', 'Terima kasih! Testimoni Anda berhasil dikirim dan sedang menunggu persetujuan admin.');
    }

    // Public method untuk menampilkan testimoni
    public function index()
    {
        $testimonials = Testimonial::approved()
            ->latest()
            ->paginate(10);

        return view('testimonials', compact('testimonials'));
    }

    // Admin method untuk menampilkan testimoni
    public function adminIndex()
    {
        $pendingTestimonials = Testimonial::pending()->latest()->get();
        $approvedTestimonials = Testimonial::approved()->latest()->paginate(10);
        $rejectedTestimonials = Testimonial::rejected()->latest()->paginate(10);
        
        return view('admin.testimonials', compact('pendingTestimonials', 'approvedTestimonials', 'rejectedTestimonials'));
    }

    public function approve($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->status = 'approved';
            $testimonial->save();

            return redirect()->route('admin.testimonials')->with('success', 'Testimoni berhasil disetujui.');

        } catch (\Exception $e) {
            Log::error('Error approving testimonial: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function reject($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->status = 'rejected';
            $testimonial->save();

            return redirect()->route('admin.testimonials')->with('success', 'Testimoni berhasil ditolak.');

        } catch (\Exception $e) {
            Log::error('Error rejecting testimonial: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->delete();

            return redirect()->route('admin.testimonials')->with('success', 'Testimoni berhasil dihapus.');

        } catch (\Exception $e) {
            Log::error('Error deleting testimonial: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    public function restore($id)
    {
        try {
            $testimonial = Testimonial::findOrFail($id);
            $testimonial->status = 'pending';
            $testimonial->save();

            return redirect()->back()->with('success', 'Testimoni berhasil dikembalikan ke status pending.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}