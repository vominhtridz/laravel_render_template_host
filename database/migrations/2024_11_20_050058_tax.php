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
       Schema::create('tax', function (Blueprint $table) {
        $table->id();
        $table->decimal('tax_rate')->nullable(value: false);
        $table->string('name')->nullable(value: false);
        $table->text('description')->nullable(true);
        $table->string('tax_type')->nullable(false);
        $table->dateTime('start_date')->nullable(true);
        $table->dateTime('end_date')->nullable(true);
        $table->string('currency')->nullable(false);
        $table->string('region')->nullable(true);
        $table->string('exemption_criteria')->nullable(true);
        $table->boolean('is_vat')->default(0);
        $table->string('applicable_to')->nullable(false);
        $table->enum('status', ['hoạt động', 'không hoạt động'])->default('hoạt động');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax');
    }
};
