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
        Schema::create('order_status', function (Blueprint $table) {
            $table->id('status_id'); // Khoá chính tự động tăng
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');; // khoá ngoại liên kết với khách hàng
            $table->string('status'); // Tên danh mục
            $table->timestamps(); // số theo dõi vận chuyển
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_status');
    }
};
