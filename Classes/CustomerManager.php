<?php
/**
 * Created by PhpStorm.
 * User: mesqu
 * Date: 17/10/2017
 * Time: 14:12
 */

class CustomerManager extends Customer
{

    //returns object USER
    public function loginCustomer($email, $password){

        $sql = new Sql();

        $result = $sql->mySelect("SELECT * FROM customer WHERE email = :EMAIL AND password = :PASSWORD",array(
            ':EMAIL' => $email,
            ':PASSWORD' => $password
        ));

        if(count($result)>0){

            $row = $result[0];
            Echo "Customer logged in<br>";
            return $this->setData($row);

        }else{

            throw new Exception('Login failed, please check your account settings');

        }

    }


    //returns Object USER
    public function loadCustomer($id){

        $sql = new Sql();
        $customer = new Customer();
        //Vai me retornar um arra de arrays, mesmo só com um resultado
        //O objecto PDO retorna um array de arrays
        $result = $sql->mySelect("SELECT * FROM customer WHERE idCustomer = :ID", array(':ID' => $id));
        //validar ver se temos valores no array
        //Como é um array de array só com 1 valor, nós queremos a posição [0] e injectamos na variável $row
        if(count($result)>0){

            $row = $result[0];

            //Vamos buscar a chave do array associativo
            //SET carrega os dados da BD para o Objecto
            $customer->setId($row['idCustomer']);
            $customer->setFirstName($row['firstName']);
            $customer->setLastName($row['lastName']);
            $customer->setEmail($row['email']);
            $customer->setPassword($row['password']);
            $customer->setState($row['state']);
            $customer->setDate(new DateTime($row['date']));

            return $customer;


        }
    }




    //returns um array de arrays com o número de arrays igual ao número de users da BD
    public function getCustomers(){

        $sql = new Sql();

        return $sql->mySelect("SELECT * FROM customer ORDER BY idCustomer");

    }



    //query to DB inserting a user
    public function insertCustomer($userData = array()){

        $sql = new Sql();

        $sql->myQuery("INSERT INTO customer VALUES (:idCustomer, :firstName, :lastName, :email, :password, :state, :date) ",
            array(
                ':idCustomer' => $userData['idCustomer'],
                ':firstName' =>  $userData['firstName'],
                ':lastName' =>  $userData['lastName'],
                ':email' =>  $userData['email'],
                ':password' =>  $userData['password'],
                ':state' =>  $userData['state'],
                ':date' =>  $userData['date']
            ));

    }


    //query to DB updating a user
    public function updateCustomer($id, $newData = array()){

        $this->loadCustomer($id);

        $sql = new Sql();

        $sql->myQuery("UPDATE customer SET firstName = :firstName, lastName = :lastName, email = :email, password = :password, state = :state, date = :date WHERE idCustomer = $id ",
            array(
                ':firstName' => $newData['firstName'],
                ':lastName'  => $newData['lastName'],
                ':email'     => $newData['email'],
                ':password'  => $newData['password'],
                ':state'     => $newData['state'],
                ':date'      => $newData['date']
            ));
    }

    public function deleteCustomer($id){

        $this->loadCustomer($id);

        $sql = new Sql();

        $sql->myQuery("DELETE FROM customer WHERE idCustomer=:ID", array(
            ':ID' => $id
        ));

    }

    //Load data to User
    //returns a USER
    public function setData($data = array()){

        $customer = new Customer();

        $customer->setId($data['idCustomer']);
        $customer->setFirstName($data['firstName']);
        $customer->setLastName($data['lastName']);
        $customer->setEmail($data['email']);
        $customer->setPassword($data['password']);
        $customer->setState($data['state']);
        $customer->setDate(new DateTime($data['date']));

        return $customer;

    }


}