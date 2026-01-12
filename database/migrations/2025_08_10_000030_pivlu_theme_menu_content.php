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
        Schema::create('pivlu_theme_menu_content', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('lang_id');
            $table->string('label', 200)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('pivlu_theme_menus')->cascadeOnDelete();
            $table->foreign('item_id')->references('id')->on('pivlu_theme_menu_items')->cascadeOnDelete();
            $table->foreign('lang_id')->references('id')->on('pivlu_languages')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_theme_menu_content');
    }
};
