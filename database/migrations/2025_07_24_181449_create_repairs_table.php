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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->string("full_name");
            $table->string("phone");
            $table->string("email");
            $table->string("address");
            
            $table->string("product_name");
            $table->string("serial_number");
            $table->date("purchase_date");
            $table->date("guarantee_date");
            $table->string("branch");
            $table->string("issue");
            $table->longText("description");
            $table->date("visit_request_date");
            $table->string("time");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
