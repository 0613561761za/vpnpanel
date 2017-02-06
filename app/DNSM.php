<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DNSM extends Model
{
    protected $table = 'dns_domain';

    protected $fillable = [

    	'domain_id', 'domain_name', 'domain_domain'
    ];
}
