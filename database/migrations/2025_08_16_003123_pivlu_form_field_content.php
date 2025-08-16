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
        Schema::create('pivlu_form_field_content', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->unsignedBigInteger('field_id');
            $table->unsignedBigInteger('lang_id')->nullable();
            $table->text('label');
            $table->text('info')->nullable();
            $table->text('dropdowns')->nullable();
            $table->timestamps();

            $table->foreign('form_id')->references('id')->on('pivlu_forms')->cascadeOnDelete();
            $table->foreign('field_id')->references('id')->on('pivlu_form_fields')->cascadeOnDelete();
            $table->foreign('lang_id')->references('id')->on('pivlu_languages')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_form_field_content');
    }
};
