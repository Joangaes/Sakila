<?php

namespace App\MongoModels;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Customers extends Eloquent
{
    protected $connection = 'mongodb';
    
    protected $collection = 'customers';

    /*protected $fillable = [
        '_id',
        'Address',
        'City',
        'Country',
        'District',
        'First Name',
        'Last Name',
        'Phone',
        'rentals'
    ];*/

    public function rentals()
    {
        return $this->embedsMany(\App\MongoModels\Rental::class);
    }

    public function scopeAmountOfTimesMovieIsRented($query,$movieName){
        
        
        return Customers::where('rentals.Film Title',$movieName)->count();
    }
}
