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
       Schema::create('cart', function (Blueprint $table) {
    $table->id();
    $table->integer('quantity')->nullable(false);
    $table->decimal('price',15,2)->nullable(false);
    $table->decimal('discount',15,2)->nullable(true);
    $table->decimal('total_price',15,2)->nullable(false);
    // Đảm bảo customer_id là unsignedBigInteger
    $table->unsignedBigInteger('customer_id');
    $table->unsignedBigInteger('product_id');
    $table->unsignedBigInteger('session_id')->nullable(true); // Phần Cho người dùng chưa đăng nhập chưa xử lý
    // Sử dụng khóa chính đúng của bảng customers
    $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
    $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
