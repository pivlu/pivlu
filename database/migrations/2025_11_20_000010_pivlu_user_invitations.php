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
        Schema::create('pivlu_user_invitations', function (Blueprint $table) {
            $table->id();
            $table->string('method', 20);
            $table->string('code', 100);
            $table->string('name', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('role', 25);
            $table->text('notes')->nullable();
            $table->timestamp('sent_at');
            $table->timestamp('open_at')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('sent_by_user_id')->nullable();
            $table->integer('resend_counter')->default(0);
            $table->string('mail_lang', 25)->nullable();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('sent_by_user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pivlu_user_invitations');
    }
};
