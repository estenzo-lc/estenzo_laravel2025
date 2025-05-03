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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); // First name
            $table->string('last_name'); // Last name
            $table->string('username')->unique(); // Username (unique constraint)
            $table->string('sex'); // Gender field (Male or Female)
            $table->string('email')->unique(); // Email field
            $table->timestamp('email_verified_at')->nullable(); // Email verification timestamp
            $table->string('password'); // Password field
            $table->rememberToken(); // Remember token for sessions
            $table->timestamps(); // Created and updated timestamps
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary(); // Email for password reset
            $table->string('token'); // Token for password reset
            $table->timestamp('created_at')->nullable(); // Token creation timestamp
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary(); // Session ID
            $table->foreignId('user_id')->nullable()->index(); // Foreign key to users table
            $table->string('ip_address', 45)->nullable(); // IP address of the user
            $table->text('user_agent')->nullable(); // User agent string (browser info)
            $table->longText('payload'); // Session payload (data)
            $table->integer('last_activity')->index(); // Last activity timestamp
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
