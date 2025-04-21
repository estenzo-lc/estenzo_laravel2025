<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_uploads', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('original_filename'); // The original filename
            $table->string('filename'); // The stored filename (hashed)
            $table->string('type'); // MIME type (e.g., image/png)
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade'); // Foreign key to users table
            $table->timestamps(); // Created at and updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_uploads');
    }
}
