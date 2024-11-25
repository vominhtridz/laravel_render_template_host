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
       Schema::create('promotion', function (Blueprint $table) {
        $table->id();
        $table->string('name')->nullable(value: false);
        $table->text('description')->nullable(value: false);
        $table->string('promotion_type')->nullable(value: true);
        $table->string('applicable_to')->nullable(value: false);
        $table->integer('used_count')->default(1);
        $table->dateTime('start_date')->nullable(value: false);
        $table->dateTime('end_date')->nullable(value: false);
        $table->decimal('discount_value', 15, 3)->nullable(value: false);
        $table->enum('status', ['hoạt động', 'không hoạt động'])->default('hoạt động');
        $table->unsignedBigInteger('product_id'); // Phần Cho người dùng chưa đăng nhập chưa xử lý
        $table->unsignedBigInteger('category_id'); // Phần Cho người dùng chưa đăng nhập chưa xử lý
        // Sử dụng khóa chính đúng của bảng customers
        $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion');
    }
};
