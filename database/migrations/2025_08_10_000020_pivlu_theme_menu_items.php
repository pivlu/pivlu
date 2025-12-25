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
        Schema::create('pivlu_theme_menu_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('menu_id');
            $table->integer('parent_id')->nullable();
            $table->string('type', 50);
            $table->text('value')->nullable();
            $table->integer('position')->default(0);
            $table->boolean('new_tab')->default(false);
            $table->unsignedBigInteger('btn_id')->nullable();            
            $table->string('icon', 150)->nullable();
            $table->timestamps();

            $table->foreign('menu_id')->references('id')->on('pivlu_theme_menus')->cascadeOnDelete();
            $table->foreign('btn_id')->references('id')->on('pivlu_theme_buttons')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_theme_menu_items');
    }
};
