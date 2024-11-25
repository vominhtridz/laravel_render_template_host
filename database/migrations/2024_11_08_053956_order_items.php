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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('order_item_id'); // Khoá chính tự động tăng
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('address_id')->references('id')->on('address')->onDelete('cascade');; // khoá ngoại liên kết với khách hàng
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');; // khoá ngoại liên kết với khách hàng
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');; // khoá ngoại liên kết với khách hàng
            $table->foreign('shipfee_id')->references('id')->on('shipfee')->onDelete('cascade');; // khoá ngoại liên kết với khách hàng
            $table->integer('quantity'); // Tên danh mục
            $table->decimal('unit_price',15,2); // Tên danh mục
            $table->decimal('total_price',15,2); // Tên danh mục
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
