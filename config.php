<?php
/**
 * Created by PhpStorm.
 * User: mesqu
 * Date: 17/10/2017
 * Time: 14:24
 */
spl_autoload_register(function($class_name){

    $filename = "Classes".DIRECTORY_SEPARATOR.$class_name.'.php';

    if(file_exists($filename)){
        require_once ($filename);

    }
});


?>