<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Projects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_manager_id')->unsigned()->nullable();
            $table->string('name', 255);
            $table->string('type', 255);
            $table->string('php_version', 255);
            $table->string('database', 255);
            $table->string('git_ssh', 255);
            $table->string('git_http', 255);
            $table->string('vagrant_ip', 255);
            $table->text('description');
            $table->text('notes');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->foreign('project_manager_id')->references('id')->on('users');
        });

        Schema::create('creators', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('creators', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('user_id')->references('id')->on('users');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('creators', function(Blueprint $table) {
            $table->dropForeign('creators_project_id_foreign');
            $table->dropForeign('creators_user_id_foreign');
        });

        Schema::drop('creators');

        Schema::table('projects', function(Blueprint $table) {
            $table->dropForeign('projects_project_manager_id_foreign');
        });

        Schema::drop('projects');
    }
}
