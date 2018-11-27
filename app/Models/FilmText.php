<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 13 Nov 2018 22:20:47 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Class FilmText
 * 
 * @property int $film_id
 * @property string $title
 * @property string $description
 *
 * @package App\Models
 */
class FilmText extends Eloquent
{
	protected $table = 'film_text';
	protected $primaryKey = 'film_id';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'film_id' => 'int'
	];

	protected $fillable = [
		'title',
		'description'
	];
}
