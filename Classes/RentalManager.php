<?php
/**
 * Created by PhpStorm.
 * User: mesqu
 * Date: 24/10/2017
 * Time: 15:59
 */

class RentalManager
{

    private function userData($idUser){

        $sql = new Sql();
        $user = new User();

        $userResult = $sql->mySelect("SELECT * FROM user WHERE idUser = :ID",
            array(':ID' => $idUser));

        if(count($userResult)>0){

            $userRow = $userResult[0];

            $user->setId($userRow['idUser']);
            $user->setFirstName($userRow['firstName']);
            $user->setLastName($userRow['lastName']);
            $user->setEmail($userRow['email']);
            $user->setPassword($userRow['password']);
            $user->setState($userRow['state']);
            $user->setDate($userRow['date']);

            return $user;
        }

    }

    private function customerData($idCustomer){

        $sql = new Sql();
        $customer = new Customer();

        $customerResult = $sql->mySelect("SELECT * FROM customer WHERE idCustomer = :ID",
            array(':ID' => $idCustomer));

        if(count($customerResult)>0){

            $customerRow = $customerResult[0];

            $customer->setId($customerRow['idCustomer']);
            $customer->setFirstName($customerRow['firstName']);
            $customer->setLastName($customerRow['lastName']);
            $customer->setEmail($customerRow['email']);
            $customer->setPassword($customerRow['password']);
            $customer->setState($customerRow['state']);
            $customer->setDate($customerRow['date']);

            return $customer;
        }
    }

    private function movieData($idMovie){

        $sql = new Sql();
        $movie = new Movie();
        $movieResult= $sql->mySelect("SELECT * FROM movie WHERE idMovie = :ID",
            array(':ID' => $idMovie));

        if(count($movieResult)>0){

            $movieRow = $movieResult[0];

            $movie->setIdMovie($movieRow['idMovie']);
            $movie->setName($movieRow['name']);
            $movie->setYear($movieRow['year']);
            $movie->setDirector($movieRow['director']);
            $movie->setCategory($movieRow['category']);
            $movie->setAvailability($movieRow['availability']);

            return $movie;
        }

    }

    private function userPermission($idUser){

        $userState = $this->userData($idUser)->getState();

        if ($userState == 0){
            return TRUE;
        }else{
            throw new Exception("User is not Logged In");
        }
    }

    private function customerPermission($idCustomer){

        $customerState = $this->customerData($idCustomer)->getState();

        if ($customerState == 0){
            return TRUE;
        }else{
            throw new Exception("Customer has no permission to rent");
        }
    }

    private function moviePermission($idMovie){

        $movieState = $this->movieData($idMovie)->getAvailability();

        if ($movieState > 0){
            return TRUE;
        }else{
            throw new Exception("Movie not available");
        }
    }

    public function rentalData($idUser, $idCustomer, $idMovie){

        $this->userPermission($idUser);
        $this->customerPermission($idCustomer);
        $this->moviePermission($idMovie);

    }

    private function display($idUser, $idCustomer, $idMovie){

        Echo "<strong>Movie Rented</strong><br>";

        Echo 'User Name: '.$this->userData($idUser)->getFirstName();
        Echo ' '.$this->userData($idUser)->getLastName();
        Echo '<br>Customer Name: '.$this->customerData($idCustomer)->getFirstName();
        Echo ' '.$this->customerData($idCustomer)->getLastName();
        Echo '<br>Movie: '.$this->movieData($idMovie)->getName();
        Echo ' Category: '.$this->movieData($idMovie)->getCategory();
        Echo'<br>';

    }

    private function movieOut($idMovie){

       $initialAvailability = $this->movieData($idMovie)->getAvailability();

       if($initialAvailability>0){

           $number = 1;
           $finalAvailability = $initialAvailability-$number;

           $sql = new Sql();
           $sql->myQuery("UPDATE movie SET availability = :availability WHERE idMovie= $idMovie",
               array(
                  'availability' => $finalAvailability
                              ));

       }else{
           throw new Exception("Movie not available");
       }

    }

    private function movieIn($idMovie){

        $currentAvailability = $this->movieData($idMovie)->getAvailability();

        $number = 1;

        $finalAvailability =$currentAvailability + $number;

        $sql = new Sql();
        $sql->myQuery("UPDATE movie SET availability = :availability WHERE idMovie= $idMovie",
            array(
                'availability' => $finalAvailability
            ));

    }

    private function customerOut($idCustomer){

        //$customerState = $this->customerData($idCustomer)->getState();

       $sql = new Sql();

       $sql->myQuery( "UPDATE customer SET state = :state WHERE idCustomer= $idCustomer",
           array(
              ':state' => '1'
           ));

    }

    private function customerIn($idCustomer){

       //$customerState = $this->customerData($idCustomer)->getState();

        $sql = new Sql();

        $sql->myQuery( "UPDATE customer SET state = :state WHERE idCustomer= $idCustomer",
            array(
                ':state' => '0'
            ));

    }


    public function rental($idUser, $idCustomer, $idMovie){


        $this->rentalData($idUser, $idCustomer, $idMovie);

        $this->display($idUser, $idCustomer, $idMovie);

        $this->movieOut($idMovie);

        $this->customerOut($idCustomer);


    }


    public function rentalRelease($idMovie, $idCustomer){

        $this->movieIn($idMovie);
        $this->customerIn($idCustomer);

    }

    /*********************************************************************/
    /************ANOTHER IMPLEMENTATION***********************************/
    /*********************************************************************/


    public function insertRental($rentalData = array()){

        $sql = new Sql();

        $sql->myQuery("INSERT INTO rental VALUES(:idRental, :idUser, :idCustomer, :idMovie, :date, :devolution)",
            array(
                ':idRental' => $rentalData['idRental'],
                ':idUser' => $rentalData['idUser'],
                ':idCustomer' => $rentalData['idCustomer'],
                ':idMovie' => $rentalData['idMovie'],
                ':date' => $rentalData['date'],
                ':devolution' => $rentalData['devolution'],
            ));
    }
    public function getRentals(){

        $sql = new Sql();

        $results = $sql->mySelect("SELECT * FROM rental ORDER BY idRental");

        foreach ($results as $result){
            Echo '<br>';
            foreach ($result as $key=>$value){

                Echo "$key: $value<br>";
            }
        }

    }


    public function updateRental($idRental, $newData = array()){

        $sql = new Sql();

        $sql->myQuery("UPDATE rental SET idUser = :idUser, idCustomer = :idCustomer, idMovie = :idMovie, date = :date, devolution = :devolution  WHERE idRental = $idRental",
            array(
                ':idUser'       => $newData['idUser'],
                ':idCustomer'   => $newData['idCustomer'],
                ':idMovie'      => $newData['idMovie'],
                ':date'         => $newData['date'],
                ':devolution'   => $newData['devolution']
            ));


    }

    public function deleteRental($idRental){

        $this->loadRental($idRental);

        $sql = new Sql();

        $sql->myQuery("DELETE FROM rental WHERE idRental=:idRental", array(
            ':idRental' => $idRental
        ));
    }

    public function loadRental($idRental)
    {
        $sql = new Sql();
        $rental = new Rental();
        //Vai me retornar um arra de arrays, mesmo só com um resultado
        //O objecto PDO retorna um array de arrays
        $result = $sql->mySelect("SELECT * FROM rental WHERE idRental = :ID",
            array(
                ':ID' => $idRental));
        //validar ver se temos valores no array
        //Como é um array de array só com 1 valor, nós queremos a posição [0] e injectamos na variável $row
        if (count($result) > 0) {

            $row = $result[0];

            //Vamos buscar a chave do array associativo
            //SET carrega os dados da BD para o Objecto
            $rental->setIdRental($row['idRental']);
            $rental->setIdUser($row['idUser']);
            $rental->setIdCustomer($row['idCustomer']);
            $rental->setIdMovie($row['idMovie']);
            $rental->setDate(new DateTime($row['date']));
            $rental->setDevolution(new DateTime($row['devolution']));

            return $rental;

        }
    }

       public function overdue($idRental){

        $rental = new Rental();
        $currentTime = new DateTime();
        $devolution = $this->loadRental($idRental)->getDevolution();
        $interval = $currentTime->diff($devolution);

        $lap = $interval->format('%H%I%S');

        $h = 30;

        if($lap > $h){
            Echo '<br><strong>User ID:</strong> '.$this->loadRental($idRental)->getIdUser();
            Echo ' <strong>Customer ID:</strong> '.$this->loadRental($idRental)->getIdCustomer();
            Echo ' <strong>Movie ID:</strong> '.$this->loadRental($idRental)->getIdMovie();

            $file = fopen("overdue.txt", "a+");

            fwrite($file, "Overdue $idRental - $lap"."\r\n");

            fclose($file);
        }

    }




}