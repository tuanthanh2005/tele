@extends('layouts.app')

@section('title', 'Bot Telegram - Kiếm Tiền Tự Động 24/7')
@section('meta_description', 'Bán bot Telegram crypto, vàng, chứng khoán. Full source code Python. Kiếm tiền tự động với affiliate. Giá chỉ từ 2-3 triệu.')

@section('content')

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
