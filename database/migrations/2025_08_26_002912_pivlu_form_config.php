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
        Schema::create('pivlu_form_config', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->unsignedBigInteger('plugin_id')->nullable();
            $table->string('name', 50);
            $table->text('value')->nullable();

            $table->foreign('form_id')->references('id')->on('pivlu_forms')->cascadeOnDelete();
            $table->foreign('plugin_id')->references('id')->on('pivlu_plugins')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_form_config');
    }
};
