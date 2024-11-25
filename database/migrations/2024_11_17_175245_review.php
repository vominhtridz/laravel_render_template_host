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
       Schema::create('reviews', function (Blueprint $table) {
    $table->id();
    $table->integer('rating');
    $table->text('content')->nullable(false);
    $table->string('images')->nullable(true);
    // Đảm bảo customer_id là unsignedBigInteger
    $table->unsignedBigInteger('customer_id');
    $table->unsignedBigInteger('product_id');
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
        Schema::dropIfExists('reviews');
    }
};
