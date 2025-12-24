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
        Schema::create('pivlu_theme_footers', function (Blueprint $table) {
            $table->id();
            $table->string('label', 50);
            $table->boolean('is_default')->default(false);
            $table->tinyInteger('footer_columns')->default(1);
            $table->boolean('footer2_show')->default(false);
            $table->tinyInteger('footer2_columns')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_theme_footers');
    }
};
