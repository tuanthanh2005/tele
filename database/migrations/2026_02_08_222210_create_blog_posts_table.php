<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tiêu đề bài viết
            $table->string('slug')->unique(); // URL friendly
            $table->text('excerpt')->nullable(); // Tóm tắt ngắn
            $table->longText('content'); // Nội dung đầy đủ
            $table->string('thumbnail')->nullable(); // Ảnh đại diện
            $table->string('meta_title')->nullable(); // SEO title
            $table->text('meta_description')->nullable(); // SEO description
            $table->string('meta_keywords')->nullable(); // SEO keywords
            $table->integer('views')->default(0); // Lượt xem
            $table->boolean('is_published')->default(false); // Đã xuất bản chưa
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
