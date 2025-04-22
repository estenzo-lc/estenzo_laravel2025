<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->after('id');
            $table->string('last_name')->after('first_name');
            $table->enum('sex', ['Male', 'Female'])->after('last_name');
            $table->date('birthday')->after('sex');
            $table->string('username')->unique()->after('birthday');
            $table->enum('user_type', ['Admin', 'Customer'])->default('Customer')->after('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['first_name', 'last_name', 'sex', 'birthday', 'username', 'user_type']);
    });
}
};
