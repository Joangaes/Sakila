<?php

namespace App\MongoModels;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use DB;
use App\MongoModels\Actor;

class Films extends Eloquent
{
    protected $connection = 'mongodb';
    
    protected $collection = 'films';

    protected $fillable = [
        '_id',
        'Actors',
        'Category',
        'Description',
        'Length',
        'Rating',
        'Rental Duration',
        'Replacement Cost',
        'Special Features',
        'Title'
    ];

    public function actors()
    {
        return $this->embedsMany(\App\MongoModels\Actor::class);
    }

    public function scopeRentedMoviesFromActor($query,$firstName,$lastName){
        return Films::where('actors.First name',$firstName)->where('actors.Last name',$lastName)->get();
    }

    public function scopeAmountOfMoviesWithCategory($query,$category){
        return Films::where('Category',$category)->count();
    }
}
