<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VPN extends Model
{
	/**
	 * Define the table name.
	 *
	 * @return table name string.
	 */

    protected $table = 'vpn_account';

    /**
     * Set the mass asignment.
     *
     * @return array()
     */

   protected $fillable = [
   		'account_name', 'account_password', 'account_server', 'account_create', 'account_expired', 'account_id'
   ];

   /**
    * Set the primary key.
    *
    * @return string
    */

   protected $primaryKey = 'account_id';
}
