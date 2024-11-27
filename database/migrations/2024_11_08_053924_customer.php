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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customer_id'); // Khoá chính tự động tăng
            $table->string('name'); // Tên danh mục
            $table->string('password'); // Tên danh mục
            $table->dateTime('birthday')->default(now()); // Tên danh mục
            $table->string('remember_token'); // Tên danh mục
            $table->string('image')->nullable(true); // Tên danh mục
            $table->string('email')->unique(); // Slug của danh mục, duy nhất
            $table->integer('phonenumber')->nullable(true); // Mô tả danh mục, có thể để trống
            $table->text('address')->nullable(true); // Mô tả danh mục, có thể để trống
            $table->string('zip_code')->nullable(true); // Mô tả danh mục, có thể để trống
            $table->string('state')->default('hoạt động'); // ID danh mục cha, nullable
            $table->timestamps(); // Cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
