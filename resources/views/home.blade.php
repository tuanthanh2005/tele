@extends('layouts.app')

@section('title', 'Bot Telegram - Kiếm Tiền Tự Động 24/7')
@section('meta_description', 'Bán bot Telegram crypto, vàng, chứng khoán. Full source code Python. Kiếm tiền tự động với affiliate. Giá chỉ từ 2-3 triệu.')

@section('content')
<!-- Hero Section -->
<section class="gradient-bg text-white py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                Kiếm Tiền Tự Động 24/7<br>
                Với <span class="text-yellow-300">Bot Telegram</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-purple-100">
                Bán bot Telegram crypto, vàng, chứng khoán. Full source code Python.<br>
                Tích hợp sẵn affiliate. Kiếm 10-50 triệu/tháng passive income.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#products" class="bg-white text-purple-600 px-8 py-4 rounded-full font-bold text-lg hover:shadow-2xl transition transform hover:scale-105">
                    🚀 Xem Sản Phẩm
                </a>
                <a href="#demo" class="glass text-white px-8 py-4 rounded-full font-bold text-lg hover:shadow-2xl transition">
                    🎮 Xem Demo
                </a>
            </div>
            
            <div class="mt-12 grid grid-cols-3 gap-8 max-w-2xl mx-auto">
                <div>
                    <div class="text-4xl font-bold text-yellow-300">3</div>
                    <div class="text-purple-100">Sản Phẩm</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-yellow-300">100%</div>
                    <div class="text-purple-100">Source Code</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-yellow-300">24/7</div>
                    <div class="text-purple-100">Support</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Tại Sao Chọn Chúng Tôi?</h2>
            <p class="text-xl text-gray-600">Không chỉ bán bot, chúng tôi bán cả hệ thống kiếm tiền</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-purple-50 to-indigo-50 card-hover">
                <div class="text-5xl mb-4">💰</div>
                <h3 class="text-2xl font-bold mb-3">Kiếm Tiền Ngay</h3>
                <p class="text-gray-600">Tích hợp sẵn affiliate Binance, Shopee, ngân hàng. Bắt đầu kiếm tiền từ ngày đầu tiên.</p>
            </div>
            
            <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-pink-50 to-rose-50 card-hover">
                <div class="text-5xl mb-4">🔧</div>
                <h3 class="text-2xl font-bold mb-3">Full Source Code</h3>
                <p class="text-gray-600">100% source code Python. Tùy chỉnh thoải mái. Không giới hạn. Sở hữu vĩnh viễn.</p>
            </div>
            
            <div class="text-center p-8 rounded-2xl bg-gradient-to-br from-green-50 to-emerald-50 card-hover">
                <div class="text-5xl mb-4">📚</div>
                <h3 class="text-2xl font-bold mb-3">Hướng Dẫn Chi Tiết</h3>
                <p class="text-gray-600">Video + tài liệu từ A-Z. Cài đặt, vận hành, kiếm tiền. Support 1 tháng miễn phí.</p>
            </div>
        </div>
    </div>
</section>

<!-- Products Section -->
<section id="products" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Sản Phẩm Bot Telegram</h2>
            <p class="text-xl text-gray-600">Chọn bot phù hợp với bạn</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
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
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 gradient-bg text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-6">Sẵn Sàng Kiếm Tiền Tự Động?</h2>
        <p class="text-xl mb-8 text-purple-100">Chỉ từ 2-3 triệu, bạn có thể sở hữu bot kiếm tiền 24/7</p>
        <a href="{{ route('products.index') }}" class="inline-block bg-white text-purple-600 px-12 py-4 rounded-full font-bold text-lg hover:shadow-2xl transition transform hover:scale-105">
            🚀 Mua Ngay Hôm Nay
        </a>
    </div>
</section>
@endsection
