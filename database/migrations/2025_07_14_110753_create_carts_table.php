<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->nullable()->constrained()->onDelete('cascade');
            $table->uuid("guest_id")->nullable();

            $table->timestamps();
        });
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cart_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            
            $table->string('color')->nullable(); // ← اللون المختار

            $table->decimal('price', 10, 2);    // product price 
            $table->integer('quantity')->default(1);
            $table->decimal('total', 10, 2); // total after discount
            
            $table->timestamps();
        });
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->uuid('guest_id')->nullable(); // للزوار
            $table->foreignId('coupon_id')->nullable()->constrained()->onDelete('set null');

            $table->decimal('subtotal', 10, 2);  // before discount
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total', 10, 2); //after discount

            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled'])->default('pending');
            
            $table->text('notes')->nullable();

            $table->timestamps();
        });
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');

            $table->string('color')->nullable(); // ← اللون المختار

            $table->decimal('price', 10, 2);    // product price 
            $table->decimal('subtotal', 10, 2);
            $table->integer('quantity')->default(1);
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('total', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('cart_items');
        Schema::dropIfExists('carts');
    }
};
