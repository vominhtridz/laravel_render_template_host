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
    Schema::create('categories', function (Blueprint $table) {
    $table->id(); // Khoá chính tự động tăng
    $table->string('name')->unique(); // Tên danh mục
    $table->string('slug')->unique(); // Slug của danh mục, duy nhất
    $table->text('description'); // Mô tả danh mục, có thể để trống
    $table->string('image'); // Mô tả danh mục, có thể để trống
    $table->unsignedBigInteger('parent_id')->nullable(); // ID danh mục cha, nullable
    $table->timestamps(); // Cột created_at và updated_at
    $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
    });
    Schema::create('products', function (Blueprint $table) {
    $table->id(); // Auto-incrementing primary key
    $table->string('name'); // Product name
    $table->text('description'); // Detailed product description
    $table->decimal('price', 15, 2); // Product price with 2 decimal places
    $table->integer('quantity'); // Quantity of products in stock
    $table->string('image'); // Path or filename for the product image
    $table->unsignedBigInteger('category_id'); // Foreign key to categories table (if you have one)
    $table->string('color'); // Color of the product (could store color names or hex code)
    $table->timestamps(); // Created and updated timestamps
    // Optional: If you're using a foreign key for category_id
    $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
        Schema::dropIfExists('products');
    }
};