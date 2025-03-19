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
$router->post('accueil', 'App\Controllers\BlogController@create');
$router->get('encadrants', 'App\Controllers\BlogController@index');
$router->get('encadrants/:id', 'App\Controllers\BlogController@show');

$router->get('admin/student','App\Controllers\Admin\StudentController@index');
$router->get('admin/student/:id','App\Controllers\Admin\StudentController@show');
$router->post('admin/student/delete/:id','App\Controllers\Admin\StudentController@delete');

$router->get('admin/dashboard','App\Controllers\Admin\DashboardController@index');

$router->get('admin/calendar','App\Controllers\Admin\CalendarController@index');

$router->get('admin/support','App\Controllers\Admin\SupportController@index');

$router->get('admin/profile','App\Controllers\Admin\ProfileController@index');

$router->get('authentification','App\Controllers\UserController@login');
$router->post('authentification','App\Controllers\UserController@loginPost');


try{
    $router->run();
}catch(NotFoundException $e){
   echo $e->error404();
}