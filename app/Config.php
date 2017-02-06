<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'vpn_config';

    protected $fillable = [
    	'config_id', 'config_name', 'config_type', 'config_server', 'config_filename'
    ];
}
