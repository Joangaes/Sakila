<?php

use Illuminate\Database\Seeder;
use App\Repositories\Customers\StoreRepository;
use App\Models\Store;

class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $repository = new StoreRepository();
        $stores = Store::All();
        foreach($stores as $store){
            $repository->createFromMySQL($store);
        }
    }
}
