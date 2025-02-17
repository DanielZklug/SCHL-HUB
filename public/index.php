<?php
require "../vendor/autoload.php";

use Router\Router;

define('VIEWS', dirname(__DIR__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);
define('SCRIPTS', strtolower(dirname($_SERVER['SCRIPT_NAME'])).DIRECTORY_SEPARATOR);

$router = new Router($_GET['url']);

$router->get('accueil', 'App\Controllers\BlogController@welcome');
$router->get('/encadrants', 'App\Controllers\BlogController@index');
$router->get('/encadrants/:id', 'App\Controllers\BlogController@show');

$router->run();