<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 13 Nov 2018 22:20:47 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Customer
 * 
 * @property int $customer_id
 * @property int $store_id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property int $address_id
 * @property bool $active
 * @property \Carbon\Carbon $create_date
 * @property \Carbon\Carbon $last_update
 * 
 * @property \App\Models\Address $address
 * @property \App\Models\Store $store
 * @property \Illuminate\Database\Eloquent\Collection $payments
 * @property \Illuminate\Database\Eloquent\Collection $rentals
 *
 * @package App\Models
 */
class Customer extends Eloquent
{
	protected $table = 'customer';
	protected $primaryKey = 'customer_id';
	public $timestamps = false;

	protected $casts = [
		'store_id' => 'int',
		'address_id' => 'int',
		'active' => 'bool'
	];

	protected $dates = [
		'create_date',
		'last_update'
	];

	protected $fillable = [
		'store_id',
		'first_name',
		'last_name',
		'email',
		'address_id',
		'active',
		'create_date',
		'last_update'
	];

	public function address()
	{
		return $this->belongsTo(\App\Models\Address::class,'address_id','address_id');
	}

	public function store()
	{
		return $this->belongsTo(\App\Models\Store::class);
	}

	public function payments()
	{
		return $this->hasMany(\App\Models\Payment::class);
	}

	public function rentals()
	{
		return $this->hasMany(\App\Models\Rental::class,'customer_id','customer_id');
	}

	
}
