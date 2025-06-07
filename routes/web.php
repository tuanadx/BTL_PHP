<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CodPaymentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/books/detail/{id}', [BookController::class, 'detail'])->name('books.detail');

// Cart Routes
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/merge', [CartController::class, 'mergeCart'])->name('cart.merge');
    Route::post('/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');
    Route::post('/remove', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout')->middleware('auth:khach_hang');
    Route::post('/process-checkout', [CartController::class, 'processCheckout'])->name('cart.process-checkout')->middleware('auth:khach_hang');
});

// Order Routes
Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success')->middleware('auth:khach_hang');
Route::get('/order/detail/{id}', [OrderController::class, 'detail'])->name('order.detail')->middleware('auth:khach_hang');
Route::post('/order/cancel/{id}', [OrderController::class, 'cancel'])->name('order.cancel')->middleware('auth:khach_hang');
Route::get('/user/orders', [OrderController::class, 'index'])->name('order.list')->middleware('auth:khach_hang');

// Authentication Routes
Route::get('/users/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/users/login', [AuthController::class, 'login']);
Route::get('/users/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/users/register', [AuthController::class, 'register']);
Route::post('/users/logout', [AuthController::class, 'logout'])->name('logout');

// User Profile Routes
Route::prefix('user')->middleware('auth:khach_hang')->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [UserController::class, 'editProfile'])->name('edit.profile');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('update.profile');
    Route::get('/change-password', [UserController::class, 'changePassword'])->name('change.password');
    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('update.password');
});

Route::middleware(['auth:khach_hang', 'admin'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('books', App\Http\Controllers\Admin\BookController::class);
    Route::resource('customers', App\Http\Controllers\Admin\CustomerController::class);
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);
    Route::resource('publishers', App\Http\Controllers\Admin\PublisherController::class);
    Route::resource('authors', App\Http\Controllers\Admin\AuthorController::class);
    Route::resource('countries', App\Http\Controllers\Admin\CountryController::class);
    
    // Customer routes
    Route::get('customers/{id}', [App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('customers.show');
    Route::put('customers/{id}/status', [App\Http\Controllers\Admin\CustomerController::class, 'updateStatus'])->name('customers.update-status');

    // Comment management routes
    Route::get('/comments', [App\Http\Controllers\Admin\CommentController::class, 'index'])->name('comments.index');
    Route::delete('/comments/{id}', [App\Http\Controllers\Admin\CommentController::class, 'destroy'])->name('comments.destroy');
});

// Comment Routes
Route::post('/comments', [CommentController::class, 'store'])
    ->name('comments.store')
    ->middleware('auth:khach_hang');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])
    ->name('comments.destroy')
    ->middleware('auth:khach_hang');

    use App\Http\Controllers\Auth\ForgotPasswordController;
    use App\Http\Controllers\Auth\ResetPasswordController;
    
    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
    
    use Mews\Captcha\CaptchaController;
    
    Route::get('captcha', [CaptchaController::class, 'getCaptcha'])->name('captcha');

// News routes
Route::get('/tin-nha-nam', [NewsController::class, 'nhanam'])->name('news.nhanam');
Route::get('/bien-tap-vien-gioi-thieu', [NewsController::class, 'editorRecommendations'])->name('news.editor_recommendations');
// Add other news routes if needed

// Review sach doc gia
Route::get('/review-sach-doc-gia', [NewsController::class, 'readerReviews'])->name('news.reader_reviews');

// Review sach tren bao chi
Route::get('/review-sach-tren-bao-chi', [NewsController::class, 'reviewBaoChi'])->name('news.review_bao_chi');

// Author routes
Route::get('/tac-gia', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/tac-gia/{id}', [AuthorController::class, 'show'])->name('authors.show');

// Contest routes
Route::prefix('cuoc-thi')->group(function () {
    Route::get('/', [ContestController::class, 'index'])->name('contest.index');
    Route::get('/ai-do-doc-cung-ta', [NewsController::class, 'aiDocCungTa'])->name('news.ai_doc_cung_ta');
});

// About page route
Route::get('/gioi-thieu', [HomeController::class, 'about'])->name('about');

// Stores page route
Route::get('/he-thong-hieu-sach', [HomeController::class, 'stores'])->name('stores');

// Payment routes
Route::post('/cod-payment', [CodPaymentController::class, 'processCodPayment'])->name('payment.cod');
Route::post('/vnpay_payment', [PaymentController::class, 'vnpay_payment'])->name('payment');
Route::get('/vnpay_return', [PaymentController::class, 'vnpay_return'])->name('payment.return');