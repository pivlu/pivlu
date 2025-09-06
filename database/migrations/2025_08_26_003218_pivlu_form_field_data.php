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
        Schema::create('pivlu_form_field_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('block_component_id');
            $table->unsignedBigInteger('form_data_id');
            $table->unsignedBigInteger('field_id');
            $table->mediumText('value')->nullable();
            $table->timestamps();

            $table->foreign('block_component_id')->references('id')->on('pivlu_block_components')->cascadeOnDelete();
            $table->foreign('form_data_id')->references('id')->on('pivlu_form_data')->cascadeOnDelete();
            $table->foreign('field_id')->references('id')->on('pivlu_form_fields')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_form_field_data');
    }
};
