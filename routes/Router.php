<?php

namespace Routes;

use App\RouteException\RouteException;

class Router
{
    private $url;
    private $routes = [];

    public function __construct($url) {

        $this->url = $url;

    }

    public function get($path, $callable)
    {
        $route = new Route($path, $callable);
        $this->routes['GET'][] = $route;
    }

    public function post($path, $callable)
    {
        $route = new Route($path, $callable);
        $this->routes['POST'][] = $route;
    }

    public function run()
    {
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new RouteException('REQUEST_METHOD does not exist');
        }

        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route){

            if($route->match($this->url)){
                return $route->execute();
                       die();
            }
        }

        throw new RouteException('Not route found');
    }
    
}