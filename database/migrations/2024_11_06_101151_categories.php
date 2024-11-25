<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */   
     public function up()
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
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
