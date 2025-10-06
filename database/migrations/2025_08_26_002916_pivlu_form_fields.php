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
        Schema::create('pivlu_form_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_id');
            $table->string('type', 250);
            $table->boolean('required')->default(false);
            $table->tinyInteger('col_md')->default(6);
            $table->boolean('active')->default(false);
            $table->integer('position')->default(0);
            $table->boolean('protected')->default(false);
            $table->boolean('is_default_name')->default(false);
            $table->boolean('is_default_email')->default(false);
            $table->boolean('is_default_subject')->default(false);
            $table->boolean('is_default_message')->default(false);
            $table->integer('min_length')->default(null);
            $table->integer('max_length')->default(null);
            $table->timestamps();

            $table->foreign('form_id')->references('id')->on('pivlu_forms')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_form_fields');
    }
};
