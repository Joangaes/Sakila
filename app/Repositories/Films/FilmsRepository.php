<?php namespace App\Repositories\Customers;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Repository;
use App\Models\Film as SQLFilm;
use App\MongoModels\Films;
use App\MongoModels\Actor;

class FilmsRepository extends Repository
{
    public function __construct()
    {
        $this->model = new Films();
    }

    public function createFromMySQL(SQLFilm $film){
        $this->model = new Films([
            '_id' => $film->film_id,
            'Category' => $film->filmCategories->first()->category->name,
            'Description' => $film->description,
            'Length' => $film->rental_duration,
            'Rating' => $film->rating,
            'Rental Duration' => $film->rental_duration,
            'Replacement Cost' => $film->replacement_cost,
            'Special Features' => $film->special_features,
            'Title' => $film->title
        ]);
        foreach($film->filmActors as $filmActor){
            $actor = $filmActor->actor;
            $newActor = new Actor([
                'actorId' => $actor->actor_id,
                'First name' => $actor->first_name,
                'Last name' => $actor->last_name
            ]);
            $this->model->actors()->associate($newActor);
        }

        $this->model->save();
    }

     // Get all instances of model
     public function rentedMoviesFromActorMongo($firstName,$lastName)
     {
         return $this->model->rentedMoviesFromActor($firstName,$lastName);
     }

     public function rentedMoviesFromActorSQL($firstName,$lastName){
         $this->model = new SQLFilm();
         $movies = $this->model->rentedMoviesFromActor($firstName,$lastName);
         $this->model = new Films();
         return $movies;
     }

     public function amountOfMoviesInCategoryMongo($category){
         return $this->model->amountOfMoviesWithCategory($category);
     }

     public function amountOfMoviesInCategorySQL($category){
        $this->model = new SQLFilm();
        $movies = $this->model->amountOfMoviesWithCategory($category);
        $this->model = new Films();
        return $movies;
     }
}