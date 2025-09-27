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
        Schema::create('pivlu_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('permission', 50);
            $table->boolean('is_core')->default(false);
            $table->unsignedBigInteger('post_type_id')->nullable();
            $table->unsignedBigInteger('plugin_id')->nullable();
            $table->text('description')->nullable();
            $table->boolean('attention')->default(false);
            $table->string('group_type')->nullable();
            $table->string('group_name')->nullable();
            $table->text('actions')->nullable();
            $table->timestamps();

            $table->foreign('post_type_id')->references('id')->on('pivlu_post_types')->nullOnDelete();
            $table->foreign('plugin_id')->references('id')->on('pivlu_plugins')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_permissions');
    }
};
