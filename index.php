<?php
namespace App;

use Core\Router;

session_start();

function autoload($class) {
    $classPath = str_replace("\\", "/", $class);
    
    $file = __DIR__ . "/" . $classPath . ".php";

    if (file_exists($file)) {
        require_once $file;
    } else {
        throw new \Exception("Class file for {$file} not found.");
    }
}



spl_autoload_register("App\\autoload");

$router = new Router();

$router->addRoute("GET", "home", "HomeController", "index");

$router->addRoute("GET", "user_edit", "UserEditController", "index");
$router->addRoute("POST", "user_edit", "UserEditController", "handleRequest");

$router->addRoute("GET", "log_in", "LogInController", "index");
$router->addRoute("POST", "log_in", "LogInController", "handleRequest");


$view = str_replace("Snapload/","", $_SERVER["REQUEST_URI"]);
$view = trim($view, "/");
if (empty($view)) {
    $view = "home";
} 
$method = $_SERVER["REQUEST_METHOD"];

$router->direct($view, $method);
?>