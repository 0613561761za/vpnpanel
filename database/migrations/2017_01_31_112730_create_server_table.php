<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function(Blueprint $table){
            $table->increments('server_id');
            $table->string('server_name');
            $table->string('server_ip');
            $table->string('server_host');
            $table->string('server_user');
            $table->string('server_password');
            $table->string('server_country');
            $table->string('server_protocol')->nullable();
            $table->string('server_port');
            $table->string('server_limit');
            $table->string('server_is_limit')->default(0);
            $table->string('server_type');
            $table->string('server_group');
            $table->string('server_account_expired');
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
        Schema::drop('servers');
    }
}
