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
            $table->id('order_id'); // Khoá chính tự động tăng
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');; // khoá ngoại liên kết với khách hàng
            $table->dateTime('order_date'); // Tên danh mục
            $table->string('order_status'); // Tên danh mục
            $table->string('payment_status'); // Tên danh mục
            $table->string('shipping_address'); // Tên danh mục
            $table->string('shipping_method'); // Tên danh mục
            $table->decimal('total_amount',15,2); // Tên danh mục
            $table->dateTime('payment_method'); // Tên danh mục
            $table->dateTime('payment_date'); // Tên danh mục
            $table->dateTime('shipped_date'); // Tên danh mục
            $table->dateTime('delivered_date'); // Tên danh mục
            
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
