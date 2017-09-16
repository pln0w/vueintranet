<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('password');
            $table->string('image', 255)->default('');
            $table->string('phone_number', 255)->nullable();
            $table->string('private_phone_number', 255)->nullable();
            $table->string('job_title', 255)->nullable();
            $table->text('key_skill')->nullable();
            $table->text('public_key')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
