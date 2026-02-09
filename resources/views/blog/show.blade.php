@extends('layouts.app')

@section('title', $post->title)
@section('meta_description', strip_tags(substr($post->content, 0, 160)))
@section('meta_keywords', 'bot telegram, ' . $post->category)

@section('content')
<div class="bg-gray-50 min-h-screen py-10">
    <div class="container mx-auto px-4 max-w-4xl">
        <a href="{{ route('blog.index') }}" class="inline-flex items-center text-gray-500 hover:text-purple-600 mb-6 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Quay lại Blog
        </a>
        
        <article class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="relative h-64 md:h-96 w-full">
                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end">
                    <div class="p-8 text-white w-full">
                         <span class="inline-block bg-purple-600 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide mb-3">{{ $post->category }}</span>
                        <h1 class="text-3xl md:text-5xl font-extrabold leading-tight mb-2">{{ $post->title }}</h1>
                        <div class="flex items-center text-sm text-gray-200">
                             <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                             {{ $post->date }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-8 md:p-12 prose prose-lg max-w-none text-gray-700">
                {!! $post->content !!}
            </div>
            
            <div class="p-8 bg-gray-50 border-t flex flex-col md:flex-row items-center justify-between">
                <div class="mb-4 md:mb-0">
                    <p class="font-bold text-gray-900">Bạn thấy bài viết hữu ích?</p>
                    <p class="text-gray-500 text-sm">Chia sẻ ngay để bạn bè cùng biết nhé!</p>
                </div>
                <div class="flex space-x-4">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        Share
                    </button>
                    <button class="bg-blue-400 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition flex items-center">
                         <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        Tweet
                    </button>
                </div>
            </div>
        </article>
        
        <!-- Related Posts (Hardcoded for now just showing button/link) -->
        <div class="mt-12 text-center">
             <a href="{{ route('blog.index') }}" class="font-bold text-purple-600 hover:text-purple-800 text-lg transition">Xem các bài viết khác &rarr;</a>
        </div>
    </div>
</div>
@endsection
