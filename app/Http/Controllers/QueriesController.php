<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Customers\FilmsRepository as MongoFilms;
use App\Repositories\Customers\CustomerRepository as MongoCustomer;

class QueriesController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    private $mongoFilms;
    private $mongoCustomer;

    public function __construct(MongoFilms $mongoFilms,MongoCustomer $mongoCustomer){
        $this->mongoFilms = $mongoFilms;
        $this->mongoCustomer = $mongoCustomer;
    }

    public function __invoke(Request $request)
    {
        for($i = 0;$i<5;$i++){
            // Peliculas en las que aparece Penelope Guiness
        $executionStartTime = microtime(true);
        $this->mongoFilms->rentedMoviesFromActorMongo('PENELOPE','GUINESS');
        $executionEndTime = microtime(true);
        $queries['mongo'] = $executionEndTime - $executionStartTime;
        //Peliculas en las que aparece Penelope Guiness
        $executionStartTime = microtime(true);
        $this->mongoFilms->rentedMoviesFromActorSQL('PENELOPE','GUINESS');
        $executionEndTime = microtime(true);
        $queries['sql'] = $executionEndTime - $executionStartTime;

        $results['query1'][] = $queries;
        }

        for($i = 0;$i<5;$i++){
            //Clientes que rentaron una pelicula
            $executionStartTime = microtime(true);
            $amount = $this->mongoCustomer->amountOfTimesMovieIsRentedMongo('PATIENT SISTER');
            $executionEndTime = microtime(true);
            $query['mongo'] = $executionEndTime - $executionStartTime;
            $executionStartTime = microtime(true);
            $amount = $this->mongoCustomer->amountOfTimesMovieIsRentedSQL('PATIENT SISTER');
            $executionEndTime = microtime(true);
            $query['sql'] = $executionEndTime - $executionStartTime;
            $results['query2'][] = $query;
        }


        //Clientes que rentaron una pelicula
        for($i = 0;$i<5;$i++){
            
            $executionStartTime = microtime(true);
            $amount = $this->mongoCustomer->amountOfTimesMovieIsRentedMongo('PATIENT SISTER');
            $executionEndTime = microtime(true);
            $query['mongo'] = $executionEndTime - $executionStartTime;
            $executionStartTime = microtime(true);
            $amount = $this->mongoCustomer->amountOfTimesMovieIsRentedSQL('PATIENT SISTER');
            $executionEndTime = microtime(true);
            $query['sql'] = $executionEndTime - $executionStartTime;
            $results['query2'][] = $query;
        }

        //Peliculas de comedia
        for($i=0;$i<5;$i++){
            $executionStartTime = microtime(true);
            $result = $this->mongoFilms->amountOfMoviesInCategoryMongo('Comedy');
            $executionEndTime = microtime(true);
            
            $queries['mongo'] = $executionEndTime - $executionStartTime;
            //Peliculas en las que aparece Penelope Guiness
            $executionStartTime = microtime(true);
            $result = $this->mongoFilms->amountOfMoviesInCategorySQL('Comedy');
            dd($result);
            $executionEndTime = microtime(true);
            $queries['sql'] = $executionEndTime - $executionStartTime;
            $results['query3'][] = $queries;
        }



        dd($results);
        
        
        
        
    }
}
