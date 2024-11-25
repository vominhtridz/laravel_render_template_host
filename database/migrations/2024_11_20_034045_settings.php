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
       Schema::create('settings', function (Blueprint $table) {
        $table->id();
        $table->string('web_name')->nullable(false);
        $table->string('email')->nullable(false);
        $table->string('logo')->nullable(true);
        $table->text('infor_bank')->nullable(true);
        $table->text('address')->nullable(true);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
