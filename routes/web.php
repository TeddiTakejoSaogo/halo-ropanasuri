<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomecareController;
use App\Http\Controllers\HospitalProfileController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/doctors', [HomeController::class, 'doctors'])->name('doctors');
Route::get('/news', [ArticleController::class, 'index'])->name('news');
Route::get('/news/{slug}', [ArticleController::class, 'show'])->name('news.detail');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/testimonials', [HomeController::class, 'testimonials'])->name('testimonials');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

// Testimonial Submit (Public)
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');

// Public routes untuk articles
Route::get('/news', [ArticleController::class, 'index'])->name('news');
Route::get('/news/{slug}', [ArticleController::class, 'show'])->name('news.detail');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store'); // Pastikan ini ada

Route::get('/homecare', [HomecareController::class, 'index'])->name('homecare');
Route::get('/homecare/{slug}', [HomecareController::class, 'show'])->name('homecare.detail');

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'throttle:60,1'])->group(function (){
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    // Doctors CRUD
    Route::get('/doctors', [DoctorController::class, 'index'])->name('admin.doctors');
    Route::get('/doctors/create', [DoctorController::class, 'create'])->name('admin.doctors.create');
    Route::post('/doctors', [DoctorController::class, 'store'])->name('admin.doctors.store');
    Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('admin.doctors.edit');
    Route::post('/doctors/{id}', [DoctorController::class, 'update'])->name('admin.doctors.update'); 
    Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])->name('admin.doctors.destroy');
    Route::post('/doctors/{id}/toggle-status', [DoctorController::class, 'toggleStatus'])->name('admin.doctors.toggle-status');    
    // Services CRUD
    Route::get('/services', [ServiceController::class, 'index'])->name('admin.services');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::post('/services', [ServiceController::class, 'store'])->name('admin.services.store');
    Route::get('/services/{id}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');
    Route::post('/services/{id}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('admin.services.toggle-status');
    // Articles CRUD
    Route::get('/news', [ArticleController::class, 'adminIndex'])->name('admin.news');
    Route::get('/news/create', [ArticleController::class, 'create'])->name('admin.news.create');
    Route::post('/news', [ArticleController::class, 'store'])->name('admin.news.store');
    Route::get('/news/{id}/edit', [ArticleController::class, 'edit'])->name('admin.news.edit');
    Route::put('/news/{id}', [ArticleController::class, 'update'])->name('admin.news.update');
    Route::delete('/news/{id}', [ArticleController::class, 'destroy'])->name('admin.news.destroy');
    Route::post('/news/{id}/toggle-status', [ArticleController::class, 'toggleStatus'])->name('admin.news.toggle-status');
    // Gallery CRUD
    Route::get('/gallery', [GalleryController::class, 'adminIndex'])->name('admin.gallery');
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('admin.gallery.create');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('admin.gallery.store');
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('admin.gallery.destroy');
    // Testimonials Management
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('admin.testimonials');
    Route::post('/testimonials/{id}/approve', [TestimonialController::class, 'approve'])->name('admin.testimonials.approve');
    Route::post('/testimonials/{id}/reject', [TestimonialController::class, 'reject'])->name('admin.testimonials.reject');
    Route::delete('/testimonials/{id}', [TestimonialController::class, 'destroy'])->name('admin.testimonials.destroy');

    // Doctors CRUD - PASTIKAN INI ADA
    Route::get('/doctors', [DoctorController::class, 'index'])->name('admin.doctors');
    Route::get('/doctors/create', [DoctorController::class, 'create'])->name('admin.doctors.create');
    Route::post('/doctors', [DoctorController::class, 'store'])->name('admin.doctors.store');
    Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('admin.doctors.edit');
    Route::put('/doctors/{id}', [DoctorController::class, 'update'])->name('admin.doctors.update');
    Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])->name('admin.doctors.destroy');
    Route::post('/doctors/{id}/toggle-status', [DoctorController::class, 'toggleStatus'])->name('admin.doctors.toggle-status');

    // Hospital Profile
    Route::get('/profile', [HospitalProfileController::class, 'show'])->name('admin.profile');
    Route::get('/profile/edit', [HospitalProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::put('/profile/update', [HospitalProfileController::class, 'update'])->name('admin.profile.update');
     // Contact Messages Management
    Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('admin.contact-messages');
    Route::get('/contact-messages/{id}', [ContactMessageController::class, 'show'])->name('admin.contact-messages.show');
    Route::put('/contact-messages/{id}', [ContactMessageController::class, 'update'])->name('admin.contact-messages.update');
    Route::delete('/contact-messages/{id}', [ContactMessageController::class, 'destroy'])->name('admin.contact-messages.destroy');
    Route::post('/contact-messages/{id}/replied', [ContactMessageController::class, 'markAsReplied'])->name('admin.contact-messages.replied');
    // Testimonials Management
    Route::get('/testimonials', [TestimonialController::class, 'adminIndex'])->name('admin.testimonials');
    Route::post('/testimonials/{id}/approve', [TestimonialController::class, 'approve'])->name('admin.testimonials.approve');
    Route::post('/testimonials/{id}/reject', [TestimonialController::class, 'reject'])->name('admin.testimonials.reject');
    Route::post('/testimonials/{id}/restore', [TestimonialController::class, 'restore'])->name('admin.testimonials.restore'); // Tambahkan ini
    Route::delete('/testimonials/{id}', [TestimonialController::class, 'destroy'])->name('admin.testimonials.destroy');
    // Homecare CRUD
    Route::get('/homecare', [HomecareController::class, 'adminIndex'])->name('admin.homecare.index');
    Route::get('/homecare/create', [HomecareController::class, 'create'])->name('admin.homecare.create');
    Route::post('/homecare', [HomecareController::class, 'store'])->name('admin.homecare.store');
    Route::get('/homecare/{id}/edit', [HomecareController::class, 'edit'])->name('admin.homecare.edit');
    Route::put('/homecare/{id}', [HomecareController::class, 'update'])->name('admin.homecare.update');
    Route::delete('/homecare/{id}', [HomecareController::class, 'destroy'])->name('admin.homecare.destroy');
});

// Public API Routes untuk doctors
Route::get('/api/doctors/{id}', [DoctorController::class, 'getDoctorDetails'])->name('api.doctors.details');
// Custom Auth Routes (gantikan Auth::routes())
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Fallback route
Route::fallback(function () {
    return redirect('/');
});