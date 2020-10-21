<?php

require('src/controller/AddModifyFilmController.php');
require('src/controller/CategoryController.php');
require('src/controller/FilmController.php');
require('src/controller/HomeController.php');
require('src/controller/LendingController.php');
require('src/model/CategoryModel.php');
require('src/model/FilmModel.php');
require('src/model/LendingModel.php');
require('src/service/ErrorService.php');

$contents = file_get_contents(__DIR__.'/config/env.json');
$obj = json_decode($contents);
define('ENV', $obj->env);

//il serait bon de déporter ces instructions dans le ErrorService
ini_set('display_errors', 0);
$error = new ErrorService();
set_error_handler([$error, "logError"]);
register_shutdown_function([$error, "fatalError"]);
$foo= new Toto();

$path = '/13-objet-projet-bibliotheque-films-cour-php';

//$page = filter_input(INPUT_GET, "page");
$page = $_SERVER['REDIRECT_URL'];
$route = array(

    "$path/home" => HomeController::class,
    "$path/form" => AddModifyFilmController::class,
    "$path/category" => CategoryController::class,
    "$path/film/([0-9]{1,5})" => FilmController::class,
    "$path/lending" => LendingController::class
);

foreach ($route as $routeValue => $className){
//    if($page === $routeValue){
    if(preg_match('#^' . $routeValue . '$#', $page, $match)){
        array_shift($match);
        $controller = new $className;
        $controller->manage(...$match);
    }
}

if(!isset($controller)){
    $controller = new HomeController();
    $controller->manage();
}
