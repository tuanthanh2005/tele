@extends('layouts.app')

@section('title', $product->name . ' - BotBanHang.vn')
@section('meta_description', $product->description)

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb -->
        <div class="mb-8">
            <a href="{{ route('home') }}" class="text-purple-600 hover:underline">Trang chủ</a>
            <span class="mx-2">/</span>
            <a href="{{ route('products.index') }}" class="text-purple-600 hover:underline">Sản phẩm</a>
            <span class="mx-2">/</span>
            <span class="text-gray-600">{{ $product->name }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 mb-16">
            <!-- Product Image -->
            <div>
                <div class="bg-gradient-to-br from-purple-400 to-indigo-600 rounded-2xl p-12 flex items-center justify-center h-96 sticky top-24">
                    <div class="text-9xl">
                        @if($product->category == 'crypto') 🪙
                        @elseif($product->category == 'gold') 💰
                        @else 📊
                        @endif
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div>
                <div class="bg-purple-100 text-purple-600 px-4 py-2 rounded-full inline-block mb-4">
                    {{ ucfirst($product->category) }}
                </div>
                
                <h1 class="text-4xl font-bold mb-4">{{ $product->name }}</h1>
                
                <div class="flex items-baseline gap-3 mb-6">
                    <span class="text-5xl font-bold text-purple-600">{{ number_format($product->price) }}đ</span>
                    @if($product->original_price)
                    <span class="text-2xl text-gray-400 line-through">{{ number_format($product->original_price) }}đ</span>
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                        -{{ round((($product->original_price - $product->price) / $product->original_price) * 100) }}%
                    </span>
                    @endif
                </div>

                <p class="text-lg text-gray-700 mb-8 leading-relaxed">{{ $product->description }}</p>

                <!-- Features -->
                <div class="bg-white rounded-2xl p-6 mb-8">
                    <h3 class="text-2xl font-bold mb-4">✨ Tính Năng Nổi Bật</h3>
                    <ul class="space-y-3">
                        @foreach($product->features as $feature)
                        <li class="flex items-start gap-3">
                            <span class="text-green-500 text-xl mt-1">✓</span>
                            <span class="text-gray-700">{{ $feature }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Tech Stack -->
                @if($product->tech_stack)
                <div class="bg-gray-100 rounded-xl p-4 mb-8">
                    <h4 class="font-bold mb-2">🛠️ Công Nghệ:</h4>
                    <p class="text-gray-600">{{ $product->tech_stack }}</p>
                </div>
                @endif

                                <!-- CTA Buttons -->
                <div class="space-y-4">
                    <a href="{{ route('orders.create', $product->slug) }}" class="block w-full bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-center px-8 py-4 rounded-full font-bold text-lg hover:shadow-2xl transition transform hover:scale-105">
                        🛒 Mua Ngay - Nhận Link Tải
                    </a>
                    <div class="text-sm text-gray-600 text-center">
                        Link download gửi qua email sau khi xác nhận thanh toán (5–30 phút).
                    </div>
<a href="https://t.me/specademy" target="_blank" class="block w-full bg-gray-100 text-gray-800 text-center px-8 py-4 rounded-full font-bold text-lg hover:bg-gray-200 transition">
                        ✉️ Tư Vấn Nhanh Trên Telegram
                    </a>
                </div>

                <!-- Trust Badges -->
                <div class="mt-8 grid grid-cols-3 gap-4 text-center">
                    <div>
                        <div class="text-3xl mb-2">✅</div>
                        <div class="text-sm font-medium">Full Source Code</div>
                    </div>
                    <div>
                        <div class="text-3xl mb-2">🔒</div>
                        <div class="text-sm font-medium">Giao link qua email</div>
                    </div>
                    <div>
                        <div class="text-3xl mb-2">💬</div>
                        <div class="text-sm font-medium">Ho tro 1 thang</div>
                    </div>
                </div>
            </div>
        </div>

                <!-- Purchase Flow + Value -->
        <div class="bg-white rounded-2xl p-8 mb-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">✅ Quy Trình Mua Hàng</h3>
                    <ol class="space-y-2 text-gray-600">
                        <li>1. Điền thông tin và tạo đơn hàng</li>
                        <li>2. Chuyển khoản theo hướng dẫn</li>
                        <li>3. Nhận link tải qua email</li>
                    </ol>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-4">📦 Bạn Nhận Được Gì?</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>✓ Full source code Python</li>
                        <li>✓ Hướng dẫn cài đặt từ A–Z</li>
                        <li>✓ Template bot & các file cần thiết</li>
                        <li>✓ Hướng dẫn kiếm tiền</li>
                        <li>✓ Support 1 tháng</li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-xl font-bold mb-4">🎯 Phù Hợp Với Ai?</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li>✓ Người muốn kiếm tiền online</li>
                        <li>✓ Marketer có community</li>
                        <li>✓ Trader crypto/vàng/CK</li>
                        <li>✓ Developer muốn side project</li>
                        <li>✓ Người có group Telegram</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
        <div>
            <h2 class="text-3xl font-bold mb-8">Sản Phẩm Liên Quan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($relatedProducts as $related)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                    <div class="h-48 bg-gradient-to-br from-purple-400 to-indigo-600 flex items-center justify-center">
                        <div class="text-8xl">
                            @if($related->category == 'crypto') 🪙
                            @elseif($related->category == 'gold') 💰
                            @else 📊
                            @endif
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold mb-2">{{ $related->name }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($related->description, 80) }}</p>
                        <div class="flex items-baseline gap-2 mb-4">
                            <span class="text-2xl font-bold text-purple-600">{{ number_format($related->price) }}đ</span>
                        </div>
                        <a href="{{ route('products.show', $related->slug) }}" class="block w-full bg-purple-600 text-white text-center px-6 py-3 rounded-full font-bold hover:bg-purple-700 transition">
                            Xem Chi Tiết
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>
@endsection






