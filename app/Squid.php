<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Squid extends Model
{
    protected $fillable = [
    	'squid_id','squid_ip','squid_port','squid_status'
    ];
}
