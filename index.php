<?php
/**
 * Created by PhpStorm.
 * User: mesqu
 * Date: 17/10/2017
 * Time: 14:25
 */

require_once ('config.php');

/***************************************************************************/
//SELECT AND SHOW CONTENT OF THE DB - USING A FUNCTION CREATED BY ME
/***************************************************************************/

$myUserManager = new UserManager();

/***************************************************************************/
//LOGIN USER
/***************************************************************************/

$userLogin = $myUserManager->loginUser('cmesquita@gmail.com','123456');

Echo $userLogin->getFirstName();
Echo '<br>';
Echo $userLogin->getLastName();

/***************************************************************************/
//LOAD USER
/***************************************************************************/

$userLoad = $myUserManager->loadUser(3);

Echo $userLoad->getFirstName();
Echo '<br>';
Echo $userLoad->getLastName();


/***************************************************************************/
//INSERT USER
/***************************************************************************/

$myUserManager->insertUser(array(

    'idUser' => '4',
    'firstName' =>'Catia',
    'lastName' =>'Mesquita',
    'email' =>'cmesquita@gmail.com',
    'password' =>'123456',
    'state' =>'0',
    'date' =>'2017-10-22 11:11:01'
));

/***************************************************************************/
//GET USERS
/***************************************************************************/

$users = $myUserManager->getUsers();

foreach ($users as $user){
    Echo "<br>";
    foreach ($user as $key=>$value ){

        Echo "$key $value <br>";

    }
}
/***************************************************************************/
//UPDATE USER
/***************************************************************************/

$myUserManager->updateUser(3, array(
    'firstName' => 'Catarina',
    'lastName' => 'Carvalho',
    'email'    => 'ccarvalho@gmail.com',
    'password' => '123456',
    'state' =>  '0',
    'date' => '2017/10/23 14:10'
));

/***************************************************************************/
//DELETE USER
/***************************************************************************/

$myUserManager->deleteUser(4);



