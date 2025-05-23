<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\AdminPengaturanController;
use App\Models\Testimonial;
use App\Http\Controllers\TestimonialController;
use App\Http\Middleware\AdminAuth;
use App\Models\Paket;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Routes umum
Route::get('/', function () {

    $pakets = Paket::all();
    $testimonials = Testimonial::all();   // ambil semua testimonial dari DB
    $pakets = Paket::all();

    // kalau kamu juga mau data lain seperti pricingPlans dan faqs,
    // pastikan sudah didefinisikan atau ambil juga dari DB

    return view('home', compact('testimonials', 'pakets'));
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/service', function () {
    return view('service');
});

Route::get('/contact', function () {
    return view('contact');
});



Route::prefix('admin')->name('admin.')->group(function () {
    // Login dan logout (tanpa middleware admin.auth)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Semua route ini hanya bisa diakses oleh admin yang login
    Route::middleware(['admin.auth'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    
        Route::resource('paket', PaketController::class)->except('show');


        Route::get('/member', [MemberController::class, 'index'])->name('member.index');

        Route::resource('pengaturan', AdminPengaturanController::class);

        Route::resource('testimonial', TestimonialController::class);

        Route::patch('/admin/member/{id}/activate', [AdminController::class, 'activateMember'])->name('admin.activate');
        Route::patch('/admin/member/{id}/deactivate', [AdminController::class, 'deactivateMember'])->name('admin.deactivate');

    });
});


// Register Admin
Route::get('/admin/register', [AuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'register']);
Route::put('/admin/paket/{id}', [PaketController::class, 'update'])->name('paket.update');

Route::post('/midtrans/notification', [PaymentController::class, 'notificationHandler']);
Route::post('/payment/token', [PaymentController::class, 'getToken'])->name('payment.token');
// Route::post('/proses-daftar', [RegistrationController::class, 'store'])->name('proses.daftar');
Route::get('/payment', [PaymentController::class, 'showForm'])->name('payment');
Route::get('/cek-midtrans', function(){
    return [
      'server_key' => config('midtrans.server_key'),
      'is_production' => config('midtrans.is_production') ? 'true' : 'false',
    ];
});
