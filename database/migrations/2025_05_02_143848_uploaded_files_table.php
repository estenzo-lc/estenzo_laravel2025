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
        Schema::create('uploads' , function(Blueprint $table){
            $table->id();
            $table->string('original_filename');
            $table->string('filename');
            $table->string('type');
            $table->uuid('uploaded_by');
            $table->timestamps();

            $table->foreign('uploaded_by')->references('id')->on('usersinfo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('uploads');
    }
};