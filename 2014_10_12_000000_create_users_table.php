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
if (!Schema::hasTable('users')) {
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone_number')->unique();
        $table->boolean('is_approved')->default(false);
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->enum('role', ['superadmin', 'administrator', 'agent', 'member'])->default('member');
        $table->unsignedBigInteger('referred_by_agent_id')->nullable();
        $table->rememberToken();
        $table->timestamps();

        $table->foreign('referred_by_agent_id')->references('id')->on('users')->onDelete('set null');
    });
}
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
