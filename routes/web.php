<?php

use Illuminate\Support\Facades\Route;
use App\Models\Paket;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaketController;

Route::get('/', function () {
    $testimonials = [
        [
            'image' => 'assets/img/testimonials/testimonials-1.jpg',
            'name' => 'Saul Goodman',
            'position' => 'CEO & Founder',
            'quote' => 'Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus.',
        ],
        [
            'image' => 'assets/img/testimonials/testimonials-2.jpg',
            'name' => 'Sara Wilsson',
            'position' => 'Designer',
            'quote' => 'Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis.',
        ],
        [
            'image' => 'assets/img/testimonials/testimonials-3.jpg',
            'name' => 'Jena Karlis',
            'position' => 'Store Owner',
            'quote' => 'Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim.',
        ],
    ];

    $pricingPlans = [
        [
            'name' => 'Free Plan',
            'description' => 'Ullam mollitia quasi nobis soluta in voluptatum et sint palora dex strater',
            'price' => 0,
            'delay' => 100,
            'featured' => false,
            'features' => [
                ['text' => 'Quam adipiscing vitae proin', 'available' => true],
                ['text' => 'Nec feugiat nisl pretium', 'available' => true],
                ['text' => 'Nulla at volutpat diam uteera', 'available' => true],
                ['text' => 'Pharetra massa massa ultricies', 'available' => false],
                ['text' => 'Massa ultricies mi quis hendrerit', 'available' => false],
                ['text' => 'Voluptate id voluptas qui sed aperiam rerum', 'available' => false],
                ['text' => 'Iure nihil dolores recusandae odit voluptatibus', 'available' => false],
            ],
        ],
        // ... data lain jika masih perlu
    ];

    $faqs = [
        [
            'question' => 'Non consectetur a erat nam at lectus urna duis?',
            'answer' => 'Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida.',
        ],
        [
            'question' => 'Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?',
            'answer' => 'Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi.',
        ],
        [
            'question' => 'Dolor sit amet consectetur adipiscing elit pellentesque?',
            'answer' => 'Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci.',
        ],
    ];

    // Ambil data paket dari database, bisa filter jika perlu
    $pakets = Paket::all();

    return view('home', compact('testimonials', 'pricingPlans', 'faqs', 'pakets'));
});

// Login Admin
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Menampilkan form register admin
Route::get('/admin/register', [AuthController::class, 'showRegisterForm'])->name('admin.register');

// Proses register admin
Route::post('/admin/register', [AuthController::class, 'register']);


Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

Route::patch('/admin/members/{id}/activate', [AdminController::class, 'activateMember'])->name('admin.activate');
Route::patch('/admin/members/{id}/deactivate', [AdminController::class, 'deactivateMember'])->name('admin.deactivate');

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('paket', PaketController::class);
});

// Frontend
Route::get('/pricing', function () {
    $pakets = \App\Models\Paket::where('status', true)->orderBy('urutan')->get();
    return view('partials.pricing', compact('pakets'));
})->name('pricing');

Route::post('/midtrans/notification', [PaymentController::class, 'notificationHandler']);
Route::post('/payment/token', [PaymentController::class, 'getToken'])->name('payment.token');
Route::post('/proses-daftar', [RegistrationController::class, 'store'])->name('proses.daftar');
Route::get('/payment', [PaymentController::class, 'showForm'])->name('payment');
Route::get('/cek-midtrans', function(){
    return [
      'server_key' => config('midtrans.server_key'),
      'is_production' => config('midtrans.is_production') ? 'true' : 'false',
    ];
});