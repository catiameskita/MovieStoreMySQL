<?php
/**
 * Created by PhpStorm.
 * User: mesqu
 * Date: 20/10/2017
 * Time: 17:32
 */


/***************************************************************************/
//SELECT USERS FROM DB
/***************************************************************************/

/*
$sql = new Sql();
$sql->beginTransaction();
$statement = $sql->prepare("SELECT * FROM user");
$statement->execute();

$results = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($results as $row){

    Echo "<br>";
    foreach ($row as $key => $value){

        Echo "<strong>$key</strong> $value<br>";

    }
}*/

/***************************************************************************/
//SELECT CUSTOMERS FROM DB
/***************************************************************************/


/*$sql = new Sql();

$sql->beginTransaction();

$statement = $sql->prepare("SELECT * FROM customer");
$statement->execute();

$results = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($results as $row){
    Echo '<br>';
    foreach ($row as $key => $value){

        Echo "<strong>$key</strong>$value<br>";

    }
}*/

/***************************************************************************/
//INSERT VALUES INTO A TABLE ON DB
/***************************************************************************/

/*$sql= new Sql();

$statement=$sql->prepare("INSERT INTO user (idUser, firstName, lastName, email, password, state, dt)
VALUES(:ID,:FNAME, :LNAME, :EMAIL, :PASSWORD, :STATE, :DT)");

$idUser = '3';
$firstName = 'Maria';
$lastName = 'Noronha';
$email = 'mnoronha@gmail.com';
$password = '123456';
$state = '1';
$dt = '2017-10-19 17:12:02';

$statement->bindParam(':ID', $idUser);
$statement->bindParam(':FNAME', $firstName);
$statement->bindParam(':LNAME', $lastName);
$statement->bindParam(':EMAIL', $email);
$statement->bindParam(':PASSWORD', $password);
$statement->bindParam(':STATE', $state);
$statement->bindParam(':DT', $dt);

$statement->execute();*/


/***************************************************************************/
//UPDATE VALUES INTO A TABLE ON DB
/***************************************************************************/
/*try{

    $sql = new Sql();

    $sql->beginTransaction();

    $statement = $sql->prepare("UPDATE user SET firstName = :FN WHERE idUser= :ID");

    $firstName = "Gabriela";
    $idUser = '1';

    $statement->bindParam(':FN', $firstName);
    $statement->bindParam(':ID', $idUser);

    $statement->execute();

    $sql->commit();

}
catch(Exception $e){

    $sql->rollBack();
    Echo 'Some sort of error occurred when updating: '.$e->getMessage();

}finally{

    Echo 'A record has been successfully updated';

}*/


/***************************************************************************/
//DELETE VALUES FROM A TABLE ON DB
/***************************************************************************/

/*try{
    $sql = new Sql();
    $sql->beginTransaction();

    $statement = $sql->prepare("DELETE FROM user WHERE idUser=?");
    $id = 10;
    $statement->execute(array($id));

    $sql->commit();


}
catch (Exception $e){

    $sql->rollBack();
    Echo 'Some sort of error occurred when deleting: '.$e->getMessage();

}
finally{

    Echo 'A record has been deleted successfully';
}
*/