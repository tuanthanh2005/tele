<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\OrderController;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Sản phẩm
Route::get('/san-pham', [ProductController::class, 'index'])->name('products.index');
Route::get('/san-pham/{slug}', [ProductController::class, 'show'])->name('products.show');

// Blog (SEO)
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Đặt hàng
Route::get('/dat-hang/{slug}', [OrderController::class, 'create'])->name('orders.create');
Route::post('/dat-hang', [OrderController::class, 'store'])->name('orders.store');
Route::get('/don-hang/{orderCode}', [OrderController::class, 'show'])->name('orders.show');
Route::post('/don-hang/{orderCode}/confirm', [OrderController::class, 'confirmPayment'])->name('orders.confirm');
Route::get('/don-hang/{orderCode}/approve/{token}', [OrderController::class, 'approveOrder'])->name('orders.approve');

Route::get('/test-email', function () {
    try {
        \Illuminate\Support\Facades\Mail::raw('Đây là email test từ BotBanHang.vn', function ($message) {
            $message->to('tranthanhtuanfix@gmail.com')
                    ->subject('Test Email - BotBanHang');
        });
        return '<h1>✅ Gửi email thành công!</h1> <p>Kiểm tra hộp thư (cả mục Spam).</p>';
    } catch (\Exception $e) {
        return '<h1>❌ Gửi thất bại!</h1> <p>Lỗi: ' . $e->getMessage() . '</p>';
    }
});

Route::get('/update-download-links', function () {
    \App\Models\Product::where('category', 'crypto')->update(['download_link' => url('/downloads/crypto-bot.zip')]);
    \App\Models\Product::where('category', 'gold')->update(['download_link' => url('/downloads/gold-bot.zip')]);
    \App\Models\Product::where('category', 'stock')->update(['download_link' => url('/downloads/stock-bot.zip')]);
    return "✅ Updated download links successfully! <br> Link Crypto: " . url('/downloads/crypto-bot.zip');
});
