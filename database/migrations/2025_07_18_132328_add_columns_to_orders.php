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
        Schema::table('orders', function (Blueprint $table) {
            // Personal data
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('city');
            $table->string('address');

            $table->enum('payment_method', ['cash', 'credit_card']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'full_name',
                'email',
                'phone',
                'city',
                'address',
                'payment_method',
            ]);
        });
    }
};
