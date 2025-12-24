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
        Schema::create('pivlu_theme_config_lang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('theme_id')->nullable();
            $table->unsignedBigInteger('lang_id')->nullable();
            $table->string('name', 100);
            $table->longText('value')->nullable();
            $table->timestamps();

            $table->foreign('theme_id')->references('id')->on('pivlu_themes')->cascadeOnDelete();
            $table->foreign('lang_id')->references('id')->on('pivlu_languages')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_theme_config_lang');
    }
};
