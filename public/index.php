<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
define('DS', DIRECTORY_SEPARATOR); // Using DS as universal pipe separator for all OS
define('ROOT', dirname(dirname(__FILE__))); // Root Directory set to ../
define('BASE_ROOT' , basename(ROOT)); // GET BaseRoot DIR

define('CONGIF_PATH', ROOT . DS . 'config' . DS); // config directory path
define('LIB_PATH', ROOT . DS . 'lib' . DS); // lib directory path
define('CONTROLLERS_PATH', ROOT . DS . 'controllers' . DS); // controllers directory path
define('MODELS_PATH', ROOT . DS . 'models' . DS); // models directory path
define('VIEWS_PATH', ROOT . DS . 'views' . DS); // models directory path

require_once(LIB_PATH . 'init.php');

session_start();

$uri = substr($_SERVER['REQUEST_URI'], strlen(BASE_ROOT)+2); // +2 means remove / before and / after root dir
App::run($uri);
