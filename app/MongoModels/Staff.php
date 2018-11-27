<?php

namespace App\MongoModels;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Staff extends Eloquent
{
    protected $fillable = [
        'Address',
        'City',
        'Country',
        'First Name',
        'Last Name',
        'Phone',
        'staffId'
    ];

    public function stores(){
        return $this->belongsToMany(\App\MongoModels\Stores::class);
    }
}
