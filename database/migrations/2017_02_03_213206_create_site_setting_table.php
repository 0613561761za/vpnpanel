<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site', function(Blueprint $table){
            $table->increments('site_id');
            $table->string('recapctcha_site_key');
            $table->string('recaptcha_secret_key');
            $table->string('cloudflare_api_key');
            $table->string('cloudflare_email_address');
            $table->string('watermark');
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
        Schema::drop('site');
    }
}
