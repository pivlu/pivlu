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
        Schema::create('pivlu_theme_nav_row_config', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nav_id');
            $table->unsignedBigInteger('row_id');
            $table->string('name', 150);
            $table->text('value')->nullable();
            $table->timestamps();

            $table->foreign('nav_id')->references('id')->on('pivlu_theme_navs')->cascadeOnDelete();  
            $table->foreign('row_id')->references('id')->on('pivlu_theme_nav_rows')->cascadeOnDelete();                        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_theme_nav_row_config');
    }
};
