<?php

namespace App\MongoModels;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Rental extends Eloquent
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'Film Title',
        'filmId',
        'payments',
        'Rental Date',
        'rentalId',
        'Return Date',
        'staffId'
    ];

    public function payments()
    {
        return $this->embedsMany(\App\MongoModels\Payment::class);
    }

    public function customer(){
        return $this->belongsTo(\App\MongoModels\Customers::class);
    }

    
}
