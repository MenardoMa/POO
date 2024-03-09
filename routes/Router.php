<?php

namespace Routes;

use App\Exception\RouteException;

class Router
{
    private string $url;
    private array $routes = [];

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function get(string $path, string|callable $action)
    {
       return $this->addRoute($path, $action, 'GET'); 
    }

    public function post(string $path, string|callable $action)
    {
       return $this->addRoute($path, $action, 'POST');
    }

    private function addRoute(string $path, string|callable $action, $method)
    {
        $route = new Route($path, $action);
        $this->routes[$method][] = $route;
        return $route;
    }

    public function run()
    {
        if(!isset($this->routes[$_SERVER["REQUEST_METHOD"]])){
            throw new RouteException("REQUEST_METHOD does not exist");
        }

        foreach($this->routes[$_SERVER["REQUEST_METHOD"]] as $route){
            if($route->match($this->url)){
                return $route->execute();
                die();
            }
        }

        throw new RouteException("Route not found");
        
    }

}