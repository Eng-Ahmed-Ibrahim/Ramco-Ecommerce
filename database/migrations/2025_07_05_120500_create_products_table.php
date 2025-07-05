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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->json('colors');
            $table->decimal('price', 10, 0);
            $table->string("thumbnail");
            $table->string('weight');
            $table->string('dimensions');
            $table->string("cooling_power");
            $table->foreignId("category_id")->constrained('categories')->onDelete('cascade');
            $table->foreignId("sub_category_id")->constrained("sub_categories")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
