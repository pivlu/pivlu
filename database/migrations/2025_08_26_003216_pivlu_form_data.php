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
        Schema::create('pivlu_form_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('block_component_id')->nullable();
            $table->string('name', 250)->nullable();
            $table->string('email', 250)->nullable();
            $table->text('subject')->nullable();
            $table->mediumText('message')->nullable();
            $table->string('ip', 50)->nullable();
            $table->text('referer')->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->boolean('is_important')->default(false);
            $table->boolean('is_spam')->default(false);
            $table->unsignedBigInteger('source_lang_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('block_component_id')->references('id')->on('pivlu_block_components')->nullOnDelete();
            $table->foreign('source_lang_id')->references('id')->on('pivlu_languages')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_form_data');
        Schema::dropSoftDeletes();
    }
};
