<?php
/**
 * Created by PhpStorm.
 * User: mesqu
 * Date: 17/10/2017
 * Time: 14:25
 */

require_once ('config.php');

$myUserManager = new UserManager();

/***************************************************************************/
//LOGIN USER
/***************************************************************************/

$userLogin = $myUserManager->loginUser('ccarvalho@gmail.com','123456');

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

        Echo "<strong>$key: </strong> $value <br>";

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

ECHO "***********************************************************************<br>";
/***************************************************************************/
/***************************************************************************/
//CUSTOMER
/***************************************************************************/
/***************************************************************************/

$myCustomerManager = new CustomerManager();

/***************************************************************************/
//LOGIN CUSTOMER
/***************************************************************************/


/***************************************************************************/
//LOAD CUSTOMER
/***************************************************************************/

$customerLoad = $myCustomerManager->loadCustomer(1);

Echo $customerLoad->getFirstName();
Echo $customerLoad->getLastName();
/***************************************************************************/
//INSERT CUSTOMER
/***************************************************************************/
$myCustomerManager->insertCustomer(array(
    'idCustomer' => '5',
    'firstName' =>'Maria',
    'lastName' =>'Machado',
    'email' =>'mmachado@gmail.com',
    'password' =>'123456',
    'state' =>'1',
    'date' =>'2017-10-23 22:09:01'

));

/***************************************************************************/
//GET CUSTOMERS
/***************************************************************************/
$customers = $myCustomerManager->getCustomers();

foreach ($customers as $customer){
    Echo "<br>";
    foreach ($customer as $key=>$value ){

        Echo  ucwords("<strong>$key:</strong> $value <br>");


    }
}


/***************************************************************************/
//UPDATE CUSTOMER
/***************************************************************************/
$myCustomerManager->updateCustomer(5,
    array(
        'idCustomer' => '5',
        'firstName' =>'Maria',
        'lastName' =>'Machado',
        'email' =>'mmachado@gmail.com',
        'password' =>'123456',
        'state' =>'1',
        'date' =>'2017-10-23 22:09:01'
    ));


/***************************************************************************/
//DELETE CUSTOMER
/***************************************************************************/

$myCustomerManager->deleteCustomer(5);

ECHO "***********************************************************************<br>";
/***************************************************************************/
/***************************************************************************/
//STORE MANAGER
/***************************************************************************/
/***************************************************************************/

$myStoreManager = new StoreManager();

/***************************************************************************/
//INSERT MOVIE
/***************************************************************************/

/*$myStoreManager->insertMovie(array(

        'idMovie' => '3',
        'name' =>'Happy Death Day',
        'year' =>'2017',
        'director' =>'Christopher Landon',
        'category' =>'Horror',
        'availability' =>'3'

    )
);*/

/***************************************************************************/
//GET MOVIES
/***************************************************************************/

$movies = $myStoreManager->getMovies();

$results = count($movies);

        Echo "MOVIE LIST<br><br>";

for($i=0 ; $i<$results; $i++){

$row = $movies[$i];

    Echo "<strong>Name: </strong>".$row['name'];
    Echo '<br>';
    Echo "<strong>Category: </strong>".$row['category'];
    Echo '<br>';
    Echo "<strong>Number available: </strong>".$row['availability'];
    Echo '<br>';
    Echo '<br>';

}

/***************************************************************************/
//LOAD MOVIE
/***************************************************************************/

$movieLoaded = $myStoreManager->loadMovie(3);

Echo $movieLoaded->getName();
Echo '<br>';
Echo $movieLoaded->getAvailability();
/***************************************************************************/
//UPDATE MOVIE
/***************************************************************************/

$myStoreManager->updateMovie(3,array(

    'name' =>'Happy Death Day',
    'year' =>'2017',
    'director' =>'Christopher Landon',
    'category' =>'Horror',
    'availability' =>'5'
));


/***************************************************************************/
//DELETE MOVIE
/***************************************************************************/

//$myStoreManager->deleteMovie(2);



