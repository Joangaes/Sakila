<?php

namespace App\MongoModels;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Inventory extends Eloquent
{
    protected $fillable = [
        'Film Title',
        'filmId',
        'InventoryId'
    ];

    public function stores(){
        return $this->belongsToMany(\App\MongoModels\Stores::class);
    }
    
}
