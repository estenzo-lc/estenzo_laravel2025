<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('original_filename'); // Original file name (e.g., test.png)
            $table->string('filename'); // Unique hashed file name (e.g., 098f6bcd4621d373cade4e832627b4f6.png)
            $table->string('type'); // MIME type (e.g., image/png)
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade'); // Foreign key referencing users table
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('uploads');
    }
}
