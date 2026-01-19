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
        Schema::create('pivlu_theme_nav_rows', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nav_id');
            $table->integer('position')->default(0);
            $table->boolean('active')->default(false);
            $table->mediumText('settings')->nullable();
            $table->timestamps();

            $table->foreign('nav_id')->references('id')->on('pivlu_theme_navs')->cascadeOnDelete();              
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_theme_nav_rows');
    }
};
