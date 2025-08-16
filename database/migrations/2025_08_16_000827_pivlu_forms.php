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
        Schema::create('pivlu_forms', function (Blueprint $table) {
            $table->id();
            $table->string('label', 250)->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('recaptcha')->default(false);
            $table->boolean('is_contact_form')->default(false);
            $table->string('size', 25)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_forms');
    }
};
