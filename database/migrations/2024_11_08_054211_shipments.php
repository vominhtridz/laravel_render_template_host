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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id('shipment_id'); // Khoá chính tự động tăng
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');; // khoá ngoại liên kết với khách hàng
            $table->enum('shipping_method',['Quốc tế','thu tiền khi giao hàng','miễn phí','chuyển phát nhanh','giao hàng nhanh']); // Tên danh mục
            $table->dateTime('shipped_date'); // Tên danh mục
            $table->dateTime('cuccess_delivery_date'); // Tên danh mục
            $table->string('tracking_number'); // số theo dõi vận chuyển
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
