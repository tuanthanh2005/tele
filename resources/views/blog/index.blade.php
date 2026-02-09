@extends('layouts.app')

@section('title', 'Blog Bot Telegram - Kiến Thức Đầu Tư & Công Nghệ 2026')
@section('meta_description', 'Tổng hợp kiến thức về Bot Telegram, Bot Crypto, Bot Chứng Khoán. Hướng dẫn cài đặt và sử dụng bot hiệu quả để kiếm tiền tự động.')
@section('meta_keywords', 'blog bot telegram, kiến thức crypto, đầu tư chứng khoán, hướng dẫn bot')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-4">Blog & Kiến Thức</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Chia sẻ kinh nghiệm đầu tư, hướng dẫn sử dụng Bot Telegram và cập nhật xu hướng công nghệ mới nhất 2026.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition duration-300 transform hover:-translate-y-1">
                <a href="{{ route('blog.show', $post['slug']) }}" class="block">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $post['image'] }}" alt="{{ $post['title'] }}" class="w-full h-full object-cover transform hover:scale-110 transition duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide">{{ $post['category'] }}</span>
                        </div>
                    </div>
                </a>
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $post['date'] }}
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 hover:text-purple-600 transition">
                        <a href="{{ route('blog.show', $post['slug']) }}">{{ $post['title'] }}</a>
                    </h2>
                    <p class="text-gray-600 mb-4 line-clamp-3 text-sm">
                        {{ $post['excerpt'] }}
                    </p>
                    <a href="{{ route('blog.show', $post['slug']) }}" class="inline-flex items-center text-purple-600 font-semibold hover:text-purple-800 transition">
                        Đọc tiếp
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</div>
@endsection
