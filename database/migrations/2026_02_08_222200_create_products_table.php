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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên bot: "Bot Crypto Alert"
            $table->string('slug')->unique(); // URL friendly: "bot-crypto-alert"
            $table->text('description'); // Mô tả chi tiết
            $table->json('features'); // Danh sách tính năng
            $table->decimal('price', 10, 0); // Giá bán (VNĐ)
            $table->decimal('original_price', 10, 0)->nullable(); // Giá gốc (để hiển thị giảm giá)
            $table->string('demo_link')->nullable(); // Link demo bot Telegram
            $table->string('download_link')->nullable(); // Link download (Google Drive)
            $table->string('thumbnail')->nullable(); // Ảnh sản phẩm
            $table->string('category'); // crypto, gold, stock
            $table->text('tech_stack')->nullable(); // Python, APIs used...
            $table->integer('sales_count')->default(0); // Số lượng đã bán
            $table->boolean('is_active')->default(true); // Còn bán không
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
