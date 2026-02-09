@extends('layouts.app')

@section('title', $post->meta_title ?? $post->title)
@section('meta_description', $post->meta_description ?? $post->excerpt)
@section('meta_keywords', $post->meta_keywords ?? '')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <!-- Breadcrumb -->
        <div class="mb-8">
            <a href="{{ route('home') }}" class="text-purple-600 hover:underline">Trang chủ</a>
            <span class="mx-2">/</span>
            <a href="{{ route('blog.index') }}" class="text-purple-600 hover:underline">Blog</a>
            <span class="mx-2">/</span>
            <span class="text-gray-600">{{ $post->title }}</span>
        </div>

        <!-- Post Content -->
        <article class="bg-white rounded-2xl shadow-lg overflow-hidden">
            @if($post->thumbnail)
            <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-96 object-cover">
            @endif
            
            <div class="p-8 md:p-12">
                <!-- Meta -->
                <div class="flex items-center gap-4 mb-6 text-gray-500">
                    <span>📅 {{ $post->published_at->format('d/m/Y') }}</span>
                    <span>•</span>
                    <span>👁️ {{ $post->views }} lượt xem</span>
                </div>

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $post->title }}</h1>

                <!-- Excerpt -->
                @if($post->excerpt)
                <div class="text-xl text-gray-600 mb-8 pb-8 border-b">
                    {{ $post->excerpt }}
                </div>
                @endif

                <!-- Content -->
                <div class="prose prose-lg max-w-none">
                    {!! nl2br(e($post->content)) !!}
                </div>

                <!-- Share Buttons -->
                <div class="mt-12 pt-8 border-t">
                    <h3 class="font-bold mb-4">Chia sẻ bài viết:</h3>
                    <div class="flex gap-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post->slug)) }}" 
                           target="_blank"
                           class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition">
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}" 
                           target="_blank"
                           class="bg-sky-500 text-white px-6 py-2 rounded-full hover:bg-sky-600 transition">
                            Twitter
                        </a>
                        <a href="https://t.me/share/url?url={{ urlencode(route('blog.show', $post->slug)) }}&text={{ urlencode($post->title) }}" 
                           target="_blank"
                           class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition">
                            Telegram
                        </a>
                    </div>
                </div>
            </div>
        </article>

        <!-- CTA -->
        <div class="mt-12 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-2xl p-8 text-center">
            <h2 class="text-3xl font-bold mb-4">Sẵn Sàng Bắt Đầu?</h2>
            <p class="text-xl mb-6">Xem các bot Telegram của chúng tôi!</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-white text-purple-600 px-8 py-3 rounded-full font-bold hover:shadow-2xl transition">
                Xem Sản Phẩm
            </a>
        </div>

        <!-- Back to Blog -->
        <div class="mt-8 text-center">
            <a href="{{ route('blog.index') }}" class="text-purple-600 hover:underline">
                ← Quay lại Blog
            </a>
        </div>
    </div>
</div>
@endsection
