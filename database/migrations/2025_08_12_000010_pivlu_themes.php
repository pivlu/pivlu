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
        Schema::create('pivlu_themes', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->char('code', 16)->unique();
            $table->string('vendor_name', 100);
            $table->string('package_name', 100);
            $table->string('views_hint', 150)->nullable();
            $table->text('description')->nullable();
            //$table->unsignedBigInteger('style_id')->nullable();
            $table->unsignedBigInteger('menu_id')->nullable();
            $table->unsignedBigInteger('footer_id')->nullable();
            $table->unsignedBigInteger('package_id')->nullable();
            $table->boolean('is_active')->default(false);
            $table->boolean('is_builder')->default(false);
            $table->timestamps();
            
            //$table->foreign('style_id')->references('id')->on('pivlu_theme_styles')->nullOnDelete();
            $table->foreign('menu_id')->references('id')->on('pivlu_theme_menus')->nullOnDelete();
            $table->foreign('footer_id')->references('id')->on('pivlu_theme_footers')->nullOnDelete();
            $table->foreign('package_id')->references('id')->on('pivlu_packages')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_themes');
    }
};

