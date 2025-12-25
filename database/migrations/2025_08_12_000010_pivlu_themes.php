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
        Schema::create('pivlu_themes', function (Blueprint $table) {
            $table->id();
            $table->string('label', 100);
            $table->string('vendor_name', 100);
            $table->string('theme_name', 100);
            $table->unsignedBigInteger('style_id')->nullable();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_builder')->default(true);
            $table->timestamps();
            
            $table->foreign('style_id')->references('id')->on('pivlu_theme_styles')->nullOnDelete();
            $table->foreign('menu_id')->references('id')->on('pivlu_theme_menus')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_themes');
    }
};

