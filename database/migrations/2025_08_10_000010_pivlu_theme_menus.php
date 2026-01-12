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
        Schema::create('pivlu_theme_menus', function (Blueprint $table) {
            $table->id();
            $table->string('label', 50);
            $table->boolean('is_default')->default(false);
            $table->unsignedBigInteger('package_id')->nullable();
            $table->timestamps();

            $table->foreign('package_id')->references('id')->on('pivlu_packages')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_theme_menus');
    }
};
