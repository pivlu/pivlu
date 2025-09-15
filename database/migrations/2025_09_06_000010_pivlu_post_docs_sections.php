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
        Schema::create('pivlu_post_docs_sections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->integer('parent_id')->nullable();
            $table->smallInteger('position')->nullable();
            $table->boolean('active')->default(false);
            $table->timestamps();

            $table->foreign('post_id')->references('id')->on('pivlu_posts')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_post_docs_sections');
    }
};
