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
       Schema::create('shipfee', function (Blueprint $table) {
        $table->id();
        $table->decimal('shipping_fee')->nullable(value: false);
        $table->string('shipfee_type')->nullable(value: false);
        $table->boolean('is_free_shipping')->nullable(value: true)->default(0);
        $table->decimal('discount_amount', 15, 3)->nullable(value: true);
        $table->enum('status', ['hoạt động', 'không hoạt động'])->default('hoạt động');
        $table->unsignedBigInteger('order_id')->nullable(true); // Phần Cho người dùng chưa đăng nhập chưa xử lý
        $table->unsignedBigInteger('order_item_id')->nullable(true); // Phần Cho người dùng chưa đăng nhập chưa xử lý
        // Sử dụng khóa chính đúng của bảng customers
        $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
        $table->foreign('order_item_id')->references('order_item_id')->on('order_items')->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipfee');
    }
};
