<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DNS extends Model
{
    protected $table = 'dns';

    protected $fillable = [
    	'dns_id', 'dns_domain','dns_target','dns_ip','dns_cf_id'
    ];
}
