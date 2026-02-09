@extends('layouts.app')

@section('title', 'Sản Phẩm Bot Telegram - BotBanHang.vn')
@section('meta_description', 'Danh sách bot Telegram: Crypto, Vàng, Chứng Khoán. Full source code Python. Kiếm tiền tự động với affiliate.')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold mb-4">Sản Phẩm Bot Telegram</h1>
            <p class="text-xl text-gray-600">Chọn bot phù hợp với bạn để bắt đầu kiếm tiền</p>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            @foreach($products as $product)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                <div class="h-48 bg-gradient-to-br from-purple-400 to-indigo-600 flex items-center justify-center">
                    <div class="text-8xl">
                        @if($product->category == 'crypto') 🪙
                        @elseif($product->category == 'gold') 💰
                        @else 📊
                        @endif
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <span class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-sm font-medium">
                            {{ ucfirst($product->category) }}
                        </span>
                        <span class="text-green-600 font-bold">Còn hàng</span>
                    </div>
                    
                    <h3 class="text-2xl font-bold mb-3">{{ $product->name }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 100) }}</p>
                    
                    <div class="mb-4">
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl font-bold text-purple-600">{{ number_format($product->price) }}đ</span>
                            @if($product->original_price)
                            <span class="text-lg text-gray-400 line-through">{{ number_format($product->original_price) }}đ</span>
                            @endif
                        </div>
                        @if($product->original_price)
                        <span class="text-sm text-green-600 font-medium">
                            Tiết kiệm {{ number_format($product->original_price - $product->price) }}đ
                        </span>
                        @endif
                    </div>
                    
                    <div class="space-y-2 mb-6">
                        @foreach($product->features as $index => $feature)
                            @if($index < 3)
                            <div class="flex items-start gap-2">
                                <span class="text-green-500 mt-1">✓</span>
                                <span class="text-sm text-gray-600">{{ $feature }}</span>
                            </div>
                            @endif
                        @endforeach
                    </div>
                    
                    <div class="flex gap-2">
                        <a href="{{ route('products.show', $product->slug) }}" class="flex-1 bg-gradient-to-r from-purple-600 to-indigo-600 text-white text-center px-6 py-3 rounded-full font-bold hover:shadow-lg transition">
                            Xem Chi Tiết
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Why Choose Us -->
        <div class="bg-white rounded-2xl p-8 mb-12">
            <h2 class="text-3xl font-bold mb-8 text-center">Tại Sao Chọn Chúng Tôi?</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="text-5xl mb-3">💰</div>
                    <h3 class="font-bold mb-2">Kiếm Tiền Ngay</h3>
                    <p class="text-sm text-gray-600">Affiliate tích hợp sẵn</p>
                </div>
                <div class="text-center">
                    <div class="text-5xl mb-3">🔧</div>
                    <h3 class="font-bold mb-2">Full Source Code</h3>
                    <p class="text-sm text-gray-600">100% Python, tùy chỉnh thoải mái</p>
                </div>
                <div class="text-center">
                    <div class="text-5xl mb-3">📚</div>
                    <h3 class="font-bold mb-2">Hướng Dẫn Chi Tiết</h3>
                    <p class="text-sm text-gray-600">Video + docs từ A-Z</p>
                </div>
                <div class="text-center">
                    <div class="text-5xl mb-3">💬</div>
                    <h3 class="font-bold mb-2">Support 24/7</h3>
                    <p class="text-sm text-gray-600">Hỗ trợ 1 tháng miễn phí</p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-2xl p-12 text-center">
            <h2 class="text-4xl font-bold mb-4">Cần Tư Vấn?</h2>
            <p class="text-xl mb-6">Liên hệ với chúng tôi để được tư vấn miễn phí!</p>
            <div class="flex gap-4 justify-center">
                <a href="https://t.me/specademy" class="bg-white text-purple-600 px-8 py-3 rounded-full font-bold hover:shadow-2xl transition">
                    📱 Telegram
                </a>
                <a href="mailto:tranthanhtuanfix@gmail.com" class="bg-white text-purple-600 px-8 py-3 rounded-full font-bold hover:shadow-2xl transition">
                    📧 Email
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
