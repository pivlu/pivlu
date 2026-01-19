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
        Schema::create('pivlu_theme_nav_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nav_id');
            $table->unsignedBigInteger('row_id');
            $table->string('column', 25)->default('left');
            $table->string('type', 25)->default('menu_links');
            $table->unsignedBigInteger('menu_links_id')->nullable();
            $table->mediumText('settings')->nullable();
            $table->integer('position')->default(0);
            $table->boolean('active')->default(false);
            $table->timestamps();

            $table->foreign('nav_id')->references('id')->on('pivlu_theme_navs')->cascadeOnDelete();            
            $table->foreign('row_id')->references('id')->on('pivlu_theme_nav_rows')->cascadeOnDelete();            
            $table->foreign('menu_links_id')->references('id')->on('pivlu_theme_menus')->nullOnDelete();       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_theme_nav_items');
    }
};
