<?php

namespace App\MongoModels;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Stores extends Eloquent
{
    protected $connection = 'mongodb';
    
    protected $collection = 'stores';

    protected $fillable = 
    [
        '_id',
        'Address',
        'City',
        'Country',
        'inventory',
        'Manager First Name',
        'Manager Last Name',
        'managerStaffId',
        'Phone',
        'staff'
    ];

    public function inventory()
    {
        return $this->embedsMany(\App\MongoModels\Inventory::class);
    }

    public function staff()
    {
        return $this->embedsMany(\App\MongoModels\Staff::class);
    }
}
