<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $table = 'site';

    protected $fillable = [
    	'recapctcha_site_key', 'recaptcha_secret_key', 'cloudflare_api_key', 'cloudflare_email_address', 'watermark'
    ];
}
