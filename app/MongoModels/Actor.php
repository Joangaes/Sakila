<?php

namespace App\MongoModels;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Actor extends Eloquent
{
    protected $fillable = [
        'actorId',
        'First name',
        'Last name',
    ];
}
