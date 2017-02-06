<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSshAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ssh_account', function(Blueprint $table){
            $table->increments('account_id');
            $table->string('account_name');
            $table->string('account_password');
            $table->string('account_server');
            $table->string('account_create');
            $table->string('account_expired');
            $table->boolean('account_status');
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
        Schema::drop('ssh_account');
    }
}
