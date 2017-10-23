<?php
/**
 * Created by PhpStorm.
 * User: mesqu
 * Date: 17/10/2017
 * Time: 15:39
 */

class Sql extends PDO
{

    //PDO instance representing a connection to a database
    public function __construct()
    {
        parent::__construct("mysql:host=localhost; dbname=moviesstore", "root", "");

    }

    private function setParameters($statement, $parameters = array()){

        foreach ($parameters as $key => $value){

            $this->setParameter($statement, $key, $value);

        }
    }

    private function setParameter($statement, $key, $value){
        //bindParam->Binds a parameter to the specified variable name
        $statement->bindParam($key, $value);

    }

    // Makes a query to BD - SELECT / INSERT / UPDATE / DELETE
    public function myQuery($rawQuery, $parameters = array()){
        //prepare -> Prepares a statement for execution and returns a statement object
        //prepare->returns a PDO object - statement
        $statement = $this->prepare($rawQuery);
        $this->setParameters($statement, $parameters);
        $statement->execute();
        //execute->Executes a prepared statement
        /*An array of values with as many elements as there are bound
          parameters in the SQL statement being executed*/
        //execute -> returns a bool
        return $statement;

    }
    // Show the result of the selected query
    public function mySelect($rawQuery, $parameters = array()) :array {

        $statement = $this->myQuery($rawQuery, $parameters);
        //fetchAll->returns an array containing all of the result set rows
        return $statement->fetchAll(PDO::FETCH_ASSOC);

    }

}