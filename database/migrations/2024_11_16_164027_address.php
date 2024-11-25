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
       Schema::create('address', function (Blueprint $table) {
    $table->id();
    $table->string('name')->nullable(false);
    $table->boolean('default')->default(false);
    $table->string('phonenumber')->nullable(false);
    $table->string('detail_address')->nullable(false);
    $table->string('city_address')->nullable(false);
    $table->string('postal_code')->nullable(false);
    // Đảm bảo customer_id là unsignedBigInteger
    $table->unsignedBigInteger('customer_id');
    // Sử dụng khóa chính đúng của bảng customers
    $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('address');
    }
};
