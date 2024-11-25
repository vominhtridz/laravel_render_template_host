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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id'); // Khoá chính tự động tăng
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');; // khoá ngoại liên kết với khách hàng
            $table->enum('payment_method',['trực tiếp','cod','ví điện tử','thẻ tín dụng','ngân hàng']); // Tên danh mục
            $table->dateTime('payment_date'); // Tên danh mục
            $table->decimal('amount',15,2); // Tên danh mục
            $table->enum('status',['chờ thanh toán','đang xử lý','thành công','thất bại','bị huỷ','chờ xác nhận','chờ xử lý','hoàn tiền','thẻ bị từ chối','đang xử lý rủi ro']); // Tên danh mục
            $table->string('transaction_id'); // Tên danh mục
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
