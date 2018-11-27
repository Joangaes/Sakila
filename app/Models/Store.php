<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 13 Nov 2018 22:20:47 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Store
 * 
 * @property int $store_id
 * @property int $manager_staff_id
 * @property int $address_id
 * @property \Carbon\Carbon $last_update
 * 
 * @property \App\Models\Address $address
 * @property \Illuminate\Database\Eloquent\Collection $staff
 * @property \Illuminate\Database\Eloquent\Collection $customers
 * @property \Illuminate\Database\Eloquent\Collection $inventories
 *
 * @package App\Models
 */
class Store extends Eloquent
{
	protected $table = 'store';
	protected $primaryKey = 'store_id';
	public $timestamps = false;

	protected $casts = [
		'manager_staff_id' => 'int',
		'address_id' => 'int'
	];

	protected $dates = [
		'last_update'
	];

	protected $fillable = [
		'manager_staff_id',
		'address_id',
		'last_update'
	];

	public function address()
	{
		return $this->belongsTo(\App\Models\Address::class,'address_id','address_id');
	}

	public function staff()
	{
		return $this->hasMany(\App\Models\Staff::class,'staff_id','manager_staff_id');
	}

	public function customers()
	{
		return $this->hasMany(\App\Models\Customer::class);
	}

	public function inventories()
	{
		return $this->hasMany(\App\Models\Inventory::class,'store_id','store_id');
	}
}
