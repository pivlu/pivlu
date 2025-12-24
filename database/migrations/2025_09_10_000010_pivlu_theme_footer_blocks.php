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
        Schema::create('pivlu_theme_footer_blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('block_type_id');
            $table->unsignedBigInteger('footer_id');
            $table->string('destination', 100);
            $table->tinyInteger('layout');
            $table->tinyInteger('col');
            $table->tinyInteger('position')->default(0);
            $table->text('settings')->nullable();
            $table->string('label', 100)->nullable();
            $table->boolean('hidden')->default(false);
            $table->timestamps();

            $table->foreign('block_type_id')->references('id')->on('pivlu_block_types')->cascadeOnDelete();
            $table->foreign('footer_id')->references('id')->on('pivlu_theme_footers')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_theme_footer_blocks');
    }
};
