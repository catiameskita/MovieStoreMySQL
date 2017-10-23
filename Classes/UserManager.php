<?php
/**
 * Created by PhpStorm.
 * User: mesqu
 * Date: 17/10/2017
 * Time: 14:12
 */

class UserManager extends User{

        //returns object USER
        public function loginUser($email, $password){

        $sql = new Sql();

        $result = $sql->mySelect("SELECT * FROM user WHERE email = :EMAIL AND password = :PASSWORD",array(
                ':EMAIL' => $email,
                ':PASSWORD' => $password
        ));

        if(count($result)>0){

            $row = $result[0];
            Echo "User logged in";
            return $this->setData($row);

        }else{

            throw new Exception('Login failed, please check your account settings');

        }

    }
    //returns Object USER
    public function loadUser($id){

        $sql = new Sql();
        $user = new User();
        //Vai me retornar um arra de arrays, mesmo só com um resultado
        //O objecto PDO retorna um array de arrays
        $result = $sql->mySelect("SELECT * FROM user WHERE idUser = :ID", array(':ID' => $id));
        //validar ver se temos valores no array
        //Como é um array de array só com 1 valor, nós queremos a posição [0] e injectamos na variável $row
        if(count($result)>0){

            $row = $result[0];

            //Vamos buscar a chave do array associativo
            //SET carrega os dados da BD para o Objecto
             $user->setId($row['idUser']);
             $user->setFirstName($row['firstName']);
             $user->setLastName($row['lastName']);
             $user->setEmail($row['email']);
             $user->setPassword($row['password']);
             $user->setState($row['state']);
             $user->setDate(new DateTime($row['date']));

             return $user;


        }
    }




    //returns um array de arrays com o número de arrays igual ao número de users da BD
    public function getUsers(){

        $sql = new Sql();

        return $sql->mySelect("SELECT * FROM user ORDER BY idUser");

    }



    //query to DB inserting a user
    public function insertUser($userData = array()){

        $sql = new Sql();

        $sql->myQuery("INSERT INTO user VALUES (:idUser, :firstName, :lastName, :email, :password, :state, :date) ",
            array(
        ':idUser' => $userData['idUser'],
        ':firstName' =>  $userData['firstName'],
        ':lastName' =>  $userData['lastName'],
        ':email' =>  $userData['email'],
        ':password' =>  $userData['password'],
        ':state' =>  $userData['state'],
        ':date' =>  $userData['date']
            ));

    }


    //query to DB updating a user
    public function updateUser($id, $newData = array()){

        $this->loadUser($id);

        $sql = new Sql();

        $sql->myQuery("UPDATE user SET firstName = :firstName, lastName = :lastName, email = :email, password = :password, state = :state, date = :date WHERE idUser = $id ",
            array(
            ':firstName' => $newData['firstName'],
            ':lastName'  => $newData['lastName'],
            ':email'     => $newData['email'],
            ':password'  => $newData['password'],
            ':state'     => $newData['state'],
            ':date'      => $newData['date']
        ));
    }

    public function deleteUser($id){

        $this->loadUser($id);

        $sql = new Sql();

        $sql->myQuery("DELETE FROM user WHERE idUSer=:ID", array(
            ':ID' => $id
        ));

    }

    //Load data to User
    //returns a USER
    public function setData($data = array()){

        $user = new User();

        $user->setId($data['idUser']);
        $user->setFirstName($data['firstName']);
        $user->setLastName($data['lastName']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->setState($data['state']='1');
        $user->setDate(new DateTime($data['date']));

        return $user;

    }



    //method allows a class to decide how it will react when it is treated like a string.
    //For example, what echo $obj; will print.
    // This method must return a string.
 /*  public function __toString()
    {
        return json_encode(array(
            'idUser'    =>   $this->getId(),
            'firstName' =>   $this->getFirstName(),
            'lastName'  =>   $this->getLastName(),
            'email'     =>   $this->getEmail(),
            'password'  =>   $this->getPassword(),
            'state'     =>   $this->getState(),
            'date'      =>   $this->getDate()->format('Y-m-d H:i:s')
        ));
    }*/


}