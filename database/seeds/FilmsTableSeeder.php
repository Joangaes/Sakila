<?php

use Illuminate\Database\Seeder;
use App\Repositories\Customers\FilmsRepository;
use App\Models\Film;

class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $repository = new FilmsRepository();
        $films = Film::All();
        foreach($films as $film){
            $repository->createFromMySQL($film);
        }
    }
}
