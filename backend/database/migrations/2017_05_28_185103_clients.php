<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Clients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->text('email', 255);
            $table->string('first_name', 255);
            $table->string('last_name', 255);
            $table->string('job_title', 255);
            $table->string('phone_number', 255);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('project_client', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned()->nullable();
            $table->integer('client_id')->unsigned()->nullable();
        });

        Schema::table('project_client', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('client_id')->references('id')->on('clients');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_client', function (Blueprint $table) {
            $table->dropForeign('project_client_project_id_foreign');
            $table->dropForeign('project_client_client_id_foreign');
        });

        Schema::drop('project_client');

        Schema::drop('clients');
    }
}
