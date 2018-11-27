<?php

use Illuminate\Database\Seeder;
use App\Repositories\Customers\CustomerRepository;
use App\Models\Customer;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $repository = new CustomerRepository();
        $customers = Customer::All();
        foreach($customers as $customer){
            $repository->createFromMySQL($customer);
        }
    }
}
