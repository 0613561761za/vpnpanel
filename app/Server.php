<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    /**
     * Define the mass assignment.
     *
     * @param array()
     */

    protected $fillable = [
    	'server_id', 'server_name', 'server_user', 'server_password', 'server_ip', 'server_host', 'server_country', 'server_protocol', 'server_port', 'server_limit', 'server_is_limit', 'server_config'
    ];
}
