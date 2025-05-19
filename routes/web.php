<?php

use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LanggananController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Models\Subscription;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified', 'role:admin|super_admin'])->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('rate', RateController::class)->only('index');
    Route::get('rate/{rating}', [RateController::class, 'destroy'])->name('rate.remove');

    // kategori
    Route::resource('category', CategoryController::class)->only(['index', 'store', 'update', 'destroy']);

    // sub kategori
    Route::get('sub-category/{category}', [SubCategoryController::class, 'index'])->name('sub-category.index');
    Route::post('sub-category/{category}', [SubCategoryController::class, 'store'])->name('sub-category.store');
    Route::resource('sub-category', SubCategoryController::class)->only(['update', 'destroy']);

    // buku
    Route::resource('book', BookController::class);
    Route::get('book/{book}/publish', [BookController::class, 'publish'])->name('book.publish');
    Route::get('book/{book}/premium', [BookController::class, 'premium'])->name('book.premium');
    Route::get('view-buku/{filename}', [BookController::class, 'viewBook'])->name('view.book');

    // Route::resource('langganan', LanggananController::class);

    // plan
    Route::resource('plan', PlanController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('blog_kategori', BlogCategoryController::class)->only(['index', 'store']);
    Route::patch('blog_kategori/{blogCategory}', [BlogCategoryController::class, 'update'])->name('blog_kategori.update');
    Route::delete('blog_kategori/{blogCategory}', [BlogCategoryController::class, 'destroy'])->name('blog_kategori.destroy');
    Route::resource('blogs', BlogController::class)->except(['show']);

    Route::post('/upload', [BlogController::class, 'upload'])->name('ckeditor.upload');

    Route::resource('usr', UserController::class)->only(['index', 'store', 'update', 'destroy']);

});

Route::middleware(['guest.auth'])->group(function() {
    Route::get('/', [LandingPageController::class, 'index'])->name('home');

    // produk
    Route::get('produk', [LandingPageController::class, 'produk'])->name('produk');
    Route::get('produk/{book}/detail', [LandingPageController::class, 'produkDetail'])->name('produk.single');
    Route::get('subscribtion', [SubscriptionController::class, 'index'])->name('subscribe.index');

    Route::get('/book-blog', [LandingPageController::class, 'blog'])->name('landing.blog');
    Route::get('/detail/{slug}/blog', [LandingPageController::class, 'blog_detail'])->name('blog.single');

    Route::get('faq', [LandingPageController::class, 'faq'])->name('faq');
    Route::get('kontak', [LandingPageController::class, 'kontak'])->name('kontak');

});

// Route::middleware(['auth', 'role:super_admin', 'verified'])->group(function () {
//     Route::resource('usr', UserController::class)->only(['index', 'store', 'update', 'destroy']);
// });

Route::middleware(['auth', 'role:user', 'verified'])->group(function () {
    Route::get('subscribtion/{plan}', [SubscriptionController::class, 'store'])->name('subscribe.store');
    Route::get('subscribe/{transaction}', [SubscriptionController::class, 'update'])->name('subscribe');
    Route::get('success/{transaction}', [SubscriptionController::class, 'success'])->name('success');
    Route::get('user-subs', [SubscriptionController::class, 'userSubs'])->name('user.subs');
    Route::delete('user-subs/{subs}', [SubscriptionController::class, 'destroy'])->name('user-subs.destroy');
    Route::post('/rating', [LandingPageController::class, 'rating'])->name('rating.post');
});

Route::middleware(['auth', 'role:user', 'verified'])->group(function () {
    Route::get('user/view-buku/{filename}', [BookController::class, 'viewBook'])->name('user-view.book');
    Route::get('user-view/book/{book}', [LandingPageController::class, 'bookView'])->name('user.book')->middleware('check.subscription');
});

require __DIR__.'/auth.php';
