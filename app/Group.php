<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'group';

    protected $fillable = [
    	'group_id', 'group_name', 'group_country', 'group_country_list', 'group_count'
    ];
}
