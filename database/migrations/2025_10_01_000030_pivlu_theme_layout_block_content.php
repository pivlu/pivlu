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
        Schema::create('pivlu_theme_layout_block_content', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('block_id');
            $table->unsignedBigInteger('lang_id')->nullable();
            $table->mediumtext('content')->nullable();
            $table->text('header')->nullable();

            $table->foreign('block_id')->references('id')->on('pivlu_theme_layout_blocks')->cascadeOnDelete();
            $table->foreign('lang_id')->references('id')->on('pivlu_languages')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_theme_layout_block_content');
    }
};
