<?php
use App\Models\Router;

ini_set('startup_display_errors', E_ALL);
ini_set('display_errors', E_ALL);
ini_set('error_reporting', E_ALL);

session_start();

$_SESSION['id_user'] = '56c5d5546bc32';

define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/');
define('WEBROOT', ROOT.'webroot/');

require_once ('vendor/autoload.php');

$router = new Router($_GET['c'], 'blog');