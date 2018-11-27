<?php

namespace App\MongoModels;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Payment extends Eloquent
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'Amount',
        'Payment Date',
        'Payment Id'
    ];

    public function retnal(){
        return $this->belongsTo(\App\MongoModels\Rental::class);
    }
}
