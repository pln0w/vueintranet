<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('server_id')->unsigned()->nullable();
            $table->string('revers', 255);
            $table->string('ip', 255);
            $table->integer('ssh_port');
            $table->string('cpu', 255);
            $table->string('ram', 255);
            $table->string('swap', 255);
            $table->string('storage', 255);
            $table->string('type', 255);
            $table->timestamp('backup_last_date')->nullable();
            $table->text('notes');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('vms', function (Blueprint $table) {
            $table->foreign('server_id')->references('id')->on('servers');
        });

        Schema::create('vm_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vm_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('username', 255);
            $table->timestamps();
        });

        Schema::table('vm_user', function (Blueprint $table) {
            $table->foreign('vm_id')->references('id')->on('vms');
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
        Schema::table('vm_user', function (Blueprint $table) {
            $table->dropForeign('vm_user_vm_id_foreign');
            $table->dropForeign('vm_user_user_id_foreign');
        });

        Schema::drop('vm_user');

        Schema::table('vms', function (Blueprint $table) {
            $table->dropForeign('vms_server_id_foreign');
        });

        Schema::drop('vms');

    }
}
