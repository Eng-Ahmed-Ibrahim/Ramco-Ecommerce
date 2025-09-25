<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_banners', function (Blueprint $table) {
            $table->string('name')->nullable()->change();
            $table->string('sub_title')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->string('link')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('home_banners', function (Blueprint $table) {
            $table->string('name')->nullable(false)->change();
            $table->string('sub_title')->nullable(false)->change();
            $table->text('description')->nullable(false)->change();
            $table->string('link')->nullable(false)->change();
        });
    }
};
