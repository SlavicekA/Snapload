<?php
namespace Core;

class Router{

    private $routes = [];

    public function addRoute($method, $view, $controller, $action){
        $this->routes[] = [
            "method" => $method,
            "view" => $view,
            "controller" => $controller,
            "action" => $action
        ];
    }

    public function direct($view, $method){
        foreach($this->routes as $route){
            if($route["view"] === $view && $route["method"] === $method){
                $controller = "Controllers\\" . $route["controller"];
                $controller = new $controller();
                $action = $route["action"];
                $controller->$action();
                exit;
            }
        }
    }
}

?>