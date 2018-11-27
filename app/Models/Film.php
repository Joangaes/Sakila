<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 13 Nov 2018 22:20:47 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class Film
 * 
 * @property int $film_id
 * @property string $title
 * @property string $description
 * @property \Carbon\Carbon $release_year
 * @property int $language_id
 * @property int $original_language_id
 * @property int $rental_duration
 * @property float $rental_rate
 * @property int $length
 * @property float $replacement_cost
 * @property string $rating
 * @property set $special_features
 * @property \Carbon\Carbon $last_update
 * 
 * @property \App\Models\Language $language
 * @property \Illuminate\Database\Eloquent\Collection $actors
 * @property \Illuminate\Database\Eloquent\Collection $categories
 * @property \Illuminate\Database\Eloquent\Collection $inventories
 *
 * @package App\Models
 */
class Film extends Eloquent
{
	protected $table = 'film';
	protected $primaryKey = 'film_id';
	public $timestamps = false;

	protected $casts = [
		'language_id' => 'int',
		'original_language_id' => 'int',
		'rental_duration' => 'int',
		'rental_rate' => 'float',
		'length' => 'int',
		'replacement_cost' => 'float',
		'special_features' => 'set'
	];

	protected $dates = [
		'release_year',
		'last_update'
	];

	protected $fillable = [
		'title',
		'description',
		'release_year',
		'language_id',
		'original_language_id',
		'rental_duration',
		'rental_rate',
		'length',
		'replacement_cost',
		'rating',
		'special_features',
		'last_update'
	];

	public function language()
	{
		return $this->belongsTo(\App\Models\Language::class, 'original_language_id');
	}

	public function actors()
	{
		return $this->belongsToMany(\App\Models\Actor::class, 'film_actor')
					->withPivot('actor_id');
	}

	public function filmActors(){
		return $this->hasMany(\App\Models\FilmActor::class, 'film_id','film_id');
	}

	public function categories()
	{
		return $this->belongsToMany(\App\Models\Category::class, 'film_category')
					->withPivot('film_id','category_id');
	}

	public function filmCategories(){
		return $this->hasMany(\App\Models\FilmCategory::class,'film_id','film_id');
	}

	public function inventories()
	{
		return $this->hasMany(\App\Models\Inventory::class,'film_id','film_id');
	}

	public function scopeAmountOfMoviesWithCategory($query,$category){
		return $this->whereHas('filmCategories.category',function($query) use ($category){
			$query->where('name',$category)->get();
		})->count();
	}
	

	public function scopeRentedMoviesFromActor($query,$firstName,$lastName){
		return Film::whereHas('filmActors.actor', function($query) use ($firstName,$lastName){
			$query->where('first_name',$firstName)
			->where('last_name',$lastName);
		})->get();
	}
}
