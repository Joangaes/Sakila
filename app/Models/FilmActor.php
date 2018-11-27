<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 13 Nov 2018 22:20:47 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class FilmActor
 * 
 * @property int $actor_id
 * @property int $film_id
 * @property \Carbon\Carbon $last_update
 * 
 * @property \App\Models\Actor $actor
 * @property \App\Models\Film $film
 *
 * @package App\Models
 */
class FilmActor extends Eloquent
{
	protected $table = 'film_actor';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'actor_id' => 'int',
		'film_id' => 'int'
	];

	protected $dates = [
		'last_update'
	];

	protected $fillable = [
		'last_update'
	];

	public function actor()
	{
		return $this->belongsTo(\App\Models\Actor::class,'actor_id','actor_id');
	}

	public function film()
	{
		return $this->belongsTo(\App\Models\Film::class);
	}
}
