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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique(); // Mã đơn hàng: ORD-20260209-001
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->decimal('amount', 10, 0); // Số tiền thanh toán
            $table->string('payment_method'); // bank_transfer, vnpay, momo
            $table->string('payment_status')->default('pending'); // pending, paid, failed
            $table->text('payment_proof')->nullable(); // Screenshot chuyển khoản
            $table->timestamp('paid_at')->nullable();
            $table->boolean('download_sent')->default(false); // Đã gửi link download chưa
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
