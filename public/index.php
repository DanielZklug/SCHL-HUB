<?php
require "../vendor/autoload.php";

use Router\Router;
use App\Exceptions\NotFoundException;

define('VIEWS', dirname(__DIR__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);
define('SCRIPTS', strtolower(dirname($_SERVER['SCRIPT_NAME'])).DIRECTORY_SEPARATOR);
define('DB_NAME',"schl_hub");
define('DB_HOST',"localhost");
define('DB_USERNAME',"root");
define('DB_PASSWORD',"");

$router = new Router($_GET['url']);

$router->get('accueil', 'App\Controllers\BlogController@welcome');
$router->get('encadrants', 'App\Controllers\BlogController@index');
$router->get('encadrants/:id', 'App\Controllers\BlogController@show');

try{
    $router->run();
}catch(NotFoundException $e){
   echo $e->error404();
}