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
            $table->text('description')->after('name')->nullable();
            $table->unsignedBigInteger('package_id')->after('description')->nullable();
            $table->unsignedBigInteger('post_type_id')->after('package_id')->nullable();
            $table->text('actions')->after('post_type_id')->nullable();
            $table->boolean('attention')->default(false);

            $table->foreign('package_id')->references('id')->on('pivlu_packages')->cascadeOnDelete();
            $table->foreign('post_type_id')->references('id')->on('pivlu_post_types')->cascadeOnDelete();
        });
        Schema::table('roles', function (Blueprint $table) {
            $table->string('label', 50)->after('name')->nullable();
            $table->text('description')->after('label')->nullable();
            $table->string('role_group', 50)->after('description')->nullable();
            $table->unsignedBigInteger('package_id')->after('role_group')->nullable();

            $table->foreign('package_id')->references('id')->on('pivlu_packages')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permissions', function (Blueprint $table) {
            $table->dropColumn('label');
            $table->dropColumn('package_id');
            $table->dropColumn('post_type_id');
            $table->dropColumn('actions');
            $table->dropColumn('attention');
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('label');
            $table->dropColumn('description');
            $table->dropColumn('role_group');
            $table->dropColumn('package_id');
        });
    }
};
