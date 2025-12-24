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
        Schema::table('permissions', function (Blueprint $table) {
            $table->string('label', 50)->after('name')->nullable();
            $table->text('description')->after('label')->nullable();
            $table->string('module_group', 50)->after('description')->nullable();
            $table->text('actions')->after('module_group')->nullable();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->string('label', 50)->after('name')->nullable();
            $table->text('description')->after('label')->nullable();
            $table->boolean('is_core')->after('description')->default(false);
            $table->boolean('is_internal')->after('is_core')->default(false);
            $table->string('module_group', 50)->after('is_internal')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('label');
            $table->dropColumn('description');
            $table->dropColumn('module_group');
            $table->dropColumn('actions');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('label');
            $table->dropColumn('description');
            $table->dropColumn('is_core');
            $table->dropColumn('is_internal');
            $table->dropColumn('module_group');
        });
    }
};
