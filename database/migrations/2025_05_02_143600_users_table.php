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
        //
        Schema::create('usersinfo', function(Blueprint $table){
            $table->uuid('id')->primary(); 
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('sex', ['Male', 'Female']);
            $table->date('birthday');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password'); 
            $table->boolean('agreed_to_terms')->default(false);
            $table->enum('user_type', ['Admin', 'Customer'])->default('Customer');
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('usersinfo');
    }
};