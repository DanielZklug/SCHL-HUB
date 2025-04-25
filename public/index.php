 <?php
require "../vendor/autoload.php";

use Router\Router;
use App\Exceptions\NotFoundException;

define('VIEWS', dirname(__DIR__).DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);
define('SCRIPTS', strtolower(dirname($_SERVER['SCRIPT_NAME']))."/");
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
$router->post('admin/student/:id','App\Controllers\Admin\StudentController@sendMessage');
$router->post('admin/student/delete/:id','App\Controllers\Admin\StudentController@delete');

$router->get('admin/dashboard','App\Controllers\Admin\DashboardController@index');

$router->get('admin/tasks','App\Controllers\Admin\TaskController@index');

$router->get('admin/settings','App\Controllers\Admin\SetController@index');

$router->get('admin/calendar','App\Controllers\Admin\CalendarController@index');
$router->get('admin/calendar/:id','App\Controllers\Admin\CalendarController@show');
$router->post('admin/calendar','App\Controllers\Admin\CalendarController@store');
$router->post('admin/calendar/delete/:id','App\Controllers\Admin\CalendarController@delete');

$router->get('admin/emails','App\Controllers\Admin\LetterController@index');
$router->get('admin/emails/:id','App\Controllers\Admin\LetterController@show');
$router->post('admin/emails/delete/:id','App\Controllers\Admin\LetterController@delete');

$router->get('admin/classroom','App\Controllers\Admin\ClassController@index');
$router->post('admin/classroom','App\Controllers\Admin\ClassController@createClass');
$router->get('admin/classroom/:id','App\Controllers\Admin\ClassController@show');
$router->post('admin/classroom/:id','App\Controllers\Admin\ClassController@publish');
$router->post('admin/classroom/delete/:id','App\Controllers\Admin\ClassController@delete');

$router->get('admin/support','App\Controllers\Admin\SupportController@index');
$router->post('admin/support/delete/:id','App\Controllers\Admin\SupportController@delete');

$router->get('admin/search','App\Controllers\Admin\SearchController@index');

$router->get('admin/profile','App\Controllers\Admin\ProfileController@index');
$router->post('admin/profile','App\Controllers\Admin\ProfileController@updateProfile');

$router->get('admin/monitor','App\Controllers\Admin\MonitorController@index');

$router->get('authentification','App\Controllers\UserController@login');
$router->get('logoutAdmin','App\Controllers\UserController@logoutAdmin');
$router->get('logoutUser','App\Controllers\UserController@logoutUser');
$router->post('authentification','App\Controllers\UserController@loginPost');

$router->get('student/dashboard','App\Controllers\Student\DashboardController@index');

$router->get('student/profile','App\Controllers\Student\ProfileController@index');
$router->post('student/profile','App\Controllers\Student\ProfileController@updateProfile');

$router->get('student/settings','App\Controllers\Student\SetController@index');

$router->get('student/tasks','App\Controllers\Student\TaskController@index');

$router->get('student/emails','App\Controllers\Student\LetterController@index');
$router->get('student/emails/:id','App\Controllers\Student\LetterController@show');
$router->post('student/emails/delete/:id','App\Controllers\Student\LetterController@delete');

$router->get('student/calendar','App\Controllers\Student\CalendarController@index');
try{
    $router->run();
}catch(NotFoundException $e){
   echo $e->error404();
}