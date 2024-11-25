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
        Schema::create('permissions_roles', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('roles_id'); // Phần Cho người dùng chưa đăng nhập chưa xử lý
        $table->unsignedBigInteger('permissions_id'); // Phần Cho người dùng chưa đăng nhập chưa xử lý
        $table->foreign('roles_id')->references('id')->on('roles')->onDelete('cascade');
        $table->foreign('permissions_id')->references('id')->on('permissions')->onDelete('cascade');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions_roles');
    }
};
