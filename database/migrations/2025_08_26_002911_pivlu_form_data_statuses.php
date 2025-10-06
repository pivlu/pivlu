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
        Schema::create('pivlu_form_data_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('label', 50);
            $table->text('description')->nullable();
            $table->boolean('is_new')->default(false);
            $table->boolean('is_closed')->default(false);
            $table->string('color', 50)->default('#8b8b8b');
            $table->tinyInteger('position')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_form_data_statuses');
    }
};
