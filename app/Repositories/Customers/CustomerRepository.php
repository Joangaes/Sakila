<?php namespace App\Repositories\Customers;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Repository;
use App\Models\Customer as SQLCustomer;
use App\MongoModels\Rental;
use App\MongoModels\Customers;
use App\MongoModels\Payment;
use App\Models\Film;
use App\Models\Rental as SQLRental;

class CustomerRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Customers();
    }

    public function amountOfTimesMovieIsRentedSQL($movieName){
        $this->model = new SQLRental();
        $amount = $this->model->amountOfTimesMovieIsRented($movieName);
        $this->model = new Customers();
        return $amount;
    }

    public function amountOfTimesMovieIsRentedMongo($movieName){
        return $this->model->amountOfTimesMovieIsRented($movieName);
    }


    public function createFromMySQL(SQLCustomer $customer){
        $this->model = new Customers([
            '_id' => $customer->customer_id,
            'Address' => $customer->address->address,
            'City' => $customer->address->city->city,
            'Country' => $customer->address->city->country->country,
            'District' => $customer->address->district,
            'First Name' => $customer->first_name,
            'Last Name' => $customer->last_name,
            'Phone' => $customer->address->phone,
        ]);
        $rentals = $customer->rentals;
        foreach($rentals as $rental){
            $payments = $rental->payments;
            $newRental = new Rental([
                'Film Title' => $rental->inventory->film->title,
                'filmId' => $rental->inventory->film->film_id,
                'Rental Date' => $rental->rental_date,
                'rentalId' => $rental->rental_id,
                'Return Date' => $rental->return_date,
                'staffId' => $rental->staff_id
            ]);
            foreach($payments as $payment){
                $newPayment = new Payment([
                    'Amount' => $payment->amount,
                    'Payment Date' => $payment->payment_date,
                    'Payment Id' => $payment->payment_id
                ]);
                $newRental->payments()->associate($newPayment);
            }
            $this->model->rentals()->associate($newRental);
        }
        $this->model->save();
    }
}