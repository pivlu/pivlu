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
        Schema::create('pivlu_theme_footer_block_content', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('footer_block_id');
            $table->unsignedBigInteger('footer_id');
            $table->unsignedBigInteger('lang_id')->nullable();
            $table->mediumtext('content')->nullable();
            $table->text('header')->nullable();

            $table->foreign('footer_block_id')->references('id')->on('pivlu_theme_footer_blocks')->cascadeOnDelete();
            $table->foreign('lang_id')->references('id')->on('pivlu_languages')->CascadeOnDelete();
            $table->foreign('footer_id')->references('id')->on('pivlu_theme_footers')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_theme_footer_block_content');
    }
};
