<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SSH extends Model
{
    protected $table = 'ssh_account';

    protected $fillable = [
    	'account_id', 'account_name','account_password', 'account_server', 'account_create', 'account_expired', 'account_status'
    ];
}
