<?php
/**
 * Created by PhpStorm.
 * User: mesqu
 * Date: 17/10/2017
 * Time: 14:12
 */

class StoreManager extends Movie
{
    public function insertMovie($movieData){

        $sql = new Sql();

        $sql->myQuery("INSERT INTO movie VALUES (:id, :name,:year, :director, :category, :availability) ", array(

            ':id' =>$movieData['idMovie'],
            ':name' =>$movieData['name'],
            ':year' =>$movieData['year'],
            ':director' =>$movieData['director'],
            ':category' =>$movieData['category'],
            ':availability' =>$movieData['availability'],
        ));
    }

    public function getMovies(){

        $sql = new Sql();

        return $sql->mySelect("SELECT * FROM movie");

    }

    public function loadMovie($idMovie){

        $sql = new Sql();
        $movie = new Movie();

        $result = $sql->mySelect("SELECT * FROM movie WHERE idMovie = :ID",
            array(
                ':ID' => $idMovie
            ));

        if(count($result)>0){

            $row = $result[0];

            $movie->setIdMovie($row['idMovie']);
            $movie->setName($row['name']);
            $movie->setYear($row['year']);
            $movie->setDirector($row['director']);
            $movie->setCategory($row['category']);
            $movie->setAvailability($row['availability']);

            return $movie;
        }

    }

    public function updateMovie($idMovie, $newData=array() ){

        $movie = $this->loadMovie($idMovie);

        $sql = new Sql();

        $sql->myQuery("UPDATE movie SET name = :name, year = :year, director = :director, category = :category, availability = :availability WHERE idMovie = $idMovie",
            array(
                ':name'      => $newData['name'],
                ':year'      => $newData['year'],
                ':director'  => $newData['director'],
                ':category'  => $newData['category'],
                ':availability'=> $newData['availability']

        ));

    }

    public function deleteMovie($idMovie){

        $sql = new Sql();

        $sql->myQuery("DELETE FROM movie WHERE idMovie = :ID",
            array(

                ':ID' => $idMovie
            ));


    }

}