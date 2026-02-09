@extends('layouts.app')

@section('title', 'Blog - Hướng Dẫn Kiếm Tiền Với Bot Telegram')
@section('meta_description', 'Blog hướng dẫn kiếm tiền online với bot Telegram, affiliate marketing, passive income.')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold mb-4">Blog</h1>
            <p class="text-xl text-gray-600">Hướng dẫn kiếm tiền với bot Telegram</p>
        </div>

        @if($posts->count() > 0)
        <!-- Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            @foreach($posts as $post)
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover">
                @if($post->thumbnail)
                <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                @else
                <div class="h-48 bg-gradient-to-br from-purple-400 to-indigo-600 flex items-center justify-center">
                    <span class="text-6xl">📝</span>
                </div>
                @endif
                
                <div class="p-6">
                    <div class="flex items-center gap-2 mb-3 text-sm text-gray-500">
                        <span>📅 {{ $post->published_at->format('d/m/Y') }}</span>
                        <span>•</span>
                        <span>👁️ {{ $post->views }} lượt xem</span>
                    </div>
                    
                    <h3 class="text-xl font-bold mb-3">{{ $post->title }}</h3>
                    
                    @if($post->excerpt)
                    <p class="text-gray-600 mb-4">{{ Str::limit($post->excerpt, 120) }}</p>
                    @else
                    <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                    @endif
                    
                    <a href="{{ route('blog.show', $post->slug) }}" class="text-purple-600 font-bold hover:underline">
                        Đọc tiếp →
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-center">
            {{ $posts->links() }}
        </div>
        
        @else
        <!-- Empty State -->
        <div class="bg-white rounded-2xl p-12 text-center">
            <div class="text-6xl mb-4">📝</div>
            <h2 class="text-2xl font-bold mb-4">Chưa Có Bài Viết</h2>
            <p class="text-gray-600 mb-6">Chúng tôi đang chuẩn bị nội dung chất lượng cho bạn!</p>
            <a href="{{ route('home') }}" class="inline-block bg-purple-600 text-white px-8 py-3 rounded-full font-bold hover:bg-purple-700 transition">
                Về Trang Chủ
            </a>
        </div>
        @endif

        <!-- Categories (Coming Soon) -->
        <div class="mt-12 bg-white rounded-2xl p-8">
            <h2 class="text-2xl font-bold mb-6">Chủ Đề Phổ Biến</h2>
            <div class="flex flex-wrap gap-3">
                <a href="#" class="bg-purple-100 text-purple-600 px-4 py-2 rounded-full hover:bg-purple-200 transition">
                    #BotTelegram
                </a>
                <a href="#" class="bg-purple-100 text-purple-600 px-4 py-2 rounded-full hover:bg-purple-200 transition">
                    #KiếmTiềnOnline
                </a>
                <a href="#" class="bg-purple-100 text-purple-600 px-4 py-2 rounded-full hover:bg-purple-200 transition">
                    #AffiliateMarketing
                </a>
                <a href="#" class="bg-purple-100 text-purple-600 px-4 py-2 rounded-full hover:bg-purple-200 transition">
                    #PassiveIncome
                </a>
                <a href="#" class="bg-purple-100 text-purple-600 px-4 py-2 rounded-full hover:bg-purple-200 transition">
                    #Crypto
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
