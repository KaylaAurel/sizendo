<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Routes umum
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
        [
            'name' => 'Business Plan',
            'description' => 'Ullam mollitia quasi nobis soluta in voluptatum et sint palora dex strater',
            'price' => 29,
            'delay' => 200,
            'featured' => true,
            'features' => [
                ['text' => 'Quam adipiscing vitae proin', 'available' => true],
                ['text' => 'Nec feugiat nisl pretium', 'available' => true],
                ['text' => 'Nulla at volutpat diam uteera', 'available' => true],
                ['text' => 'Pharetra massa massa ultricies', 'available' => true],
                ['text' => 'Massa ultricies mi quis hendrerit', 'available' => true],
                ['text' => 'Voluptate id voluptas qui sed aperiam rerum', 'available' => true],
                ['text' => 'Iure nihil dolores recusandae odit voluptatibus', 'available' => false],
            ],
        ],
        [
            'name' => 'Developer Plan',
            'description' => 'Ullam mollitia quasi nobis soluta in voluptatum et sint palora dex strater',
            'price' => 49,
            'delay' => 300,
            'featured' => false,
            'features' => [
                ['text' => 'Quam adipiscing vitae proin', 'available' => true],
                ['text' => 'Nec feugiat nisl pretium', 'available' => true],
                ['text' => 'Nulla at volutpat diam uteera', 'available' => true],
                ['text' => 'Pharetra massa massa ultricies', 'available' => true],
                ['text' => 'Massa ultricies mi quis hendrerit', 'available' => true],
                ['text' => 'Voluptate id voluptas qui sed aperiam rerum', 'available' => true],
                ['text' => 'Iure nihil dolores recusandae odit voluptatibus', 'available' => true],
            ],
        ],
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

    return view('home', compact('testimonials', 'pricingPlans', 'faqs'));
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

// Login Admin
Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Dashboard Admin
Route::get('/admin/dashboard', function () {
    if (!session('admin')) {
        return redirect('/admin/login');
    }
    return view('admin.dashboard');
});

// Register Admin
Route::get('/admin/register', [AuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/admin/register', [AuthController::class, 'register']);
use App\Http\Controllers\MemberController;

Route::post('/proses-daftar', [MemberController::class, 'store']);



