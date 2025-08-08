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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // مثل: Syria Branch
            $table->string('office_address')->nullable();
            $table->string('office_tel')->nullable();
            $table->string('office_fax')->nullable();
            $table->string('mobile_whatsapp')->nullable();
            $table->string('office_email')->nullable();
            $table->string('factory_address')->nullable();
            $table->string('factory_tel')->nullable();
            $table->string('factory_email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
