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
        Schema::create('pivlu_theme_layout_blocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->string('label', 100)->nullable();
            $table->unsignedBigInteger('layout_id');
            $table->text('settings')->nullable();
            $table->string('section', 25)->nullable();
            $table->integer('position')->default(0);
            $table->boolean('hidden')->default(false);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('type_id')->references('id')->on('pivlu_block_types')->nullOnDelete();
            $table->foreign('layout_id')->references('id')->on('pivlu_theme_layouts')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_theme_layout_blocks');
    }
};
