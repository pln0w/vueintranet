<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Servers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('revers', 255);
            $table->string('ip', 255);
            $table->integer('ssh_port');
            $table->string('provider', 255);
            $table->string('cpu', 255);
            $table->string('ram', 255);
            $table->string('swap', 255);
            $table->string('storage', 255);
            $table->timestamp('payment_date')->nullable();
            $table->text('notes');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('servers');
    }
}
