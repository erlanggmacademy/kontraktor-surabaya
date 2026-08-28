<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;

// ═══════════════════════════════════════════════════════
//  PUBLIC ROUTES (Sisi Depan Website)
// ═══════════════════════════════════════════════════════

Route::get('/', [HomeController::class, 'index'])->name('home');

// Tentang Kami
Route::get('/tentang-kami', [HomeController::class, 'about'])->name('about');

// Layanan
Route::get('/layanan', [ServiceController::class, 'index'])->name('services.index');
Route::get('/layanan/{slug}', [ServiceController::class, 'show'])->name('services.show');

// Portofolio
Route::get('/portofolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portofolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');

// Artikel / Blog
Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Kontak & Form Request Quote
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
Route::get('/kontak/terima-kasih', [ContactController::class, 'thankyou'])->name('contact.thankyou');

// ═══════════════════════════════════════════════════════
//  ADMIN ROUTES (Dilindungi Middleware Auth)
// ═══════════════════════════════════════════════════════

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Kelola Layanan
    Route::resource('layanan', AdminServiceController::class);

    // Kelola Portofolio
    Route::resource('portofolio', AdminPortfolioController::class);

    // Kelola Artikel
    Route::resource('artikel', AdminArticleController::class);

    // Kelola Inbox Pesan
    Route::get('pesan', [AdminMessageController::class, 'index'])->name('pesan.index');
    Route::get('pesan/{message}', [AdminMessageController::class, 'show'])->name('pesan.show');
    Route::delete('pesan/{message}', [AdminMessageController::class, 'destroy'])->name('pesan.destroy');
    // Alias route messages
    Route::get('messages', [AdminMessageController::class, 'index'])->name('messages.index');
    Route::get('messages/{message}', [AdminMessageController::class, 'show'])->name('messages.show');
    Route::delete('messages/{message}', [AdminMessageController::class, 'destroy'])->name('messages.destroy');

    // Pengaturan Website
    Route::get('pengaturan', [AdminSettingController::class, 'edit'])->name('settings.edit');
    Route::put('pengaturan', [AdminSettingController::class, 'update'])->name('settings.update');
    Route::get('pengaturan-web', [AdminSettingController::class, 'edit'])->name('pengaturan.edit');
    Route::put('pengaturan-web', [AdminSettingController::class, 'update'])->name('pengaturan.update');
});

// ═══════════════════════════════════════════════════════
//  AUTH ROUTES (dari Laravel Breeze)
// ═══════════════════════════════════════════════════════

require __DIR__.'/auth.php';
