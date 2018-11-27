<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 13 Nov 2018 22:20:47 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class FilmCategory
 * 
 * @property int $film_id
 * @property int $category_id
 * @property \Carbon\Carbon $last_update
 * 
 * @property \App\Models\Category $category
 * @property \App\Models\Film $film
 *
 * @package App\Models
 */
class FilmCategory extends Eloquent
{
	protected $table = 'film_category';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'film_id' => 'int',
		'category_id' => 'int'
	];

	protected $dates = [
		'last_update'
	];

	protected $fillable = [
		'last_update'
	];

	public function category()
	{
		return $this->belongsTo(\App\Models\Category::class,'category_id','category_id');
	}

	public function film()
	{
		return $this->belongsTo(\App\Models\Film::class,'film_id','film_id');
	}
}
