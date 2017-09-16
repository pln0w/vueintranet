<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Websites extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vm_id')->unsigned()->nullable();
            $table->integer('project_id')->unsigned()->nullable();
            $table->string('domain', 255);
            $table->string('type', 255);
            $table->timestamp('backup_last_date')->nullable();
            $table->text('notes');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('websites', function (Blueprint $table) {
            $table->foreign('vm_id')->references('id')->on('vms');
            $table->foreign('project_id')->references('id')->on('projects');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('websites', function (Blueprint $table) {
            $table->dropForeign('websites_vm_id_foreign');
            $table->dropForeign('websites_project_id_foreign');
        });

        Schema::drop('websites');
    }
}
