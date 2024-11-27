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
        // Create `address` table first
        Schema::create('address', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->boolean('default')->default(false);
            $table->string('phonenumber')->nullable(false);
            $table->string('detail_address')->nullable(false);
            $table->string('city_address')->nullable(false);
            $table->string('postal_code')->nullable(false);
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
            $table->timestamps();
        });

        // Create `shipfee` table next
        Schema::create('shipfee', function (Blueprint $table) {
            $table->id();
            $table->decimal('shipping_fee', 15, 2)->nullable(false);
            $table->string('shipfee_type')->nullable(false);
            $table->boolean('is_free_shipping')->nullable()->default(0);
            $table->decimal('discount_amount', 15, 3)->nullable();
            $table->enum('status', ['hoạt động', 'không hoạt động'])->default('hoạt động');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->timestamps();
        });

        // Create `order_items` table
        Schema::create('order_items', function (Blueprint $table) {
            $table->id('order_item_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('address_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('shipfee_id')->nullable();
            $table->foreign('address_id')->references('id')->on('address')->onDelete('cascade');
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('unit_price', 15, 2);
            $table->decimal('total_price', 15, 2);
            $table->timestamps();
        });

        // Add the foreign key for `order_item_id` in `shipfee`
        Schema::table('shipfee', function (Blueprint $table) {
            $table->unsignedBigInteger('order_item_id')->nullable();
            $table->foreign('order_item_id')->references('order_item_id')->on('order_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipfee');
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('address');
    }
};

