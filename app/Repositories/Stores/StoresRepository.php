<?php namespace App\Repositories\Customers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Cache\Repository;
use App\Models\Store as SQLStore;
use App\MongoModels\Stores;
use App\MongoModels\Inventory;
use App\MongoModels\Staff;

class StoreRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Stores();
    }


    public function createFromMySQL(SQLStore $store){
        $store->load(['inventories','staff']);
        $this->model = new Stores([
            '_id' => $store->store_id,
            'Address' => $store->address->address,
            'City' => $store->address->city->city,
            'Country' => $store->address->city->country->country,
            'Manager First Name' => $store->staff->first()->first_name,
            'Manager Last Name' => $store->staff->first()->last_name,
            'managerStaffId'=> $store->staff->first()->staff_id,
            'Phone' => $store->address->phone,
        ]);
        foreach($store->inventories as $item){
            $newItem = new Inventory([
                'film_id' => $item->film_id,
                'store_id' => $item->store_id,
                'last_update' => $item->last_update,
            ]);
            $this->model->inventory()->associate($newItem);
        }
        
        
        foreach($store->staff as $staff){
            $newStaff = new Staff([
                'Address' => $staff->address->address,
                'City' => $staff->address->city->city,
                'Country' => $staff->address->city->country->country,
                'First Name' => $staff->first_name,
                'Last Name' => $staff->last_name,
                'staffId'=> $staff->staff_id,
                'Phone' => $staff->address->phone,
            ]);
            $this->model->staff()->associate($newStaff);
        }
        
        $this->model->save();
    }
}