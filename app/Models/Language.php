<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 13 Nov 2018 22:20:47 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Language
 * 
 * @property int $language_id
 * @property string $name
 * @property \Carbon\Carbon $last_update
 * 
 * @property \Illuminate\Database\Eloquent\Collection $films
 *
 * @package App\Models
 */
class Language extends Eloquent
{
	protected $table = 'language';
	protected $primaryKey = 'language_id';
	public $timestamps = false;

	protected $dates = [
		'last_update'
	];

	protected $fillable = [
		'name',
		'last_update'
	];

	public function films()
	{
		return $this->hasMany(\App\Models\Film::class, 'original_language_id');
	}
}
