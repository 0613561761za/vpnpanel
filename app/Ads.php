<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    /**
     * Define the table name
     *
     */

    protected $table = 'ads';

    /**
     * Allow the mass assignment.
     *
     */

    protected $fillable = [
    	'ads_id', 'ads_name', 'ads_body','ads_type'
    ];
}
