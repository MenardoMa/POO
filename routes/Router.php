<?php

namespace Routes;

class Router
{
    private string $url;
    private array $routes;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function get(string $path, string $action)
    {
        return $this->addMethod($path, $action, 'GET'); 
    }

    public function post(string $path, string $action)
    {
        return $this->addMethod($path, $action, 'POST');         
    }

    public function addMethod($path, $action, $method)
    {
        $route = new Route($path, $action);
        $this->routes[$method][] = $route;
        return $route;
    }

    public function run()
    {
        if(!isset($this->routes[$_SERVER['REQUEST_METHOD']])){
            throw new Exception("REQUEST_METHOD does not exist");
        }

        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route)
        {   
            if($route->match($this->url)){
                return $route->execute();
                die();
            }
        }

        return throw new Exception("Page Not Found");

    }

    /**
     * name
     */

     public function url($name, $param = [])
     {
        foreach($this->routes as $k => $v)
        {
            foreach($this->routes[$k] as $routes){
                if(array_key_exists($name, $routes->name())){
                    $route = $routes->name();
                    $path  = $route[$name];
                    if(!empty($param)){
                        foreach($param as $k => $v){
                            $url = str_replace("{{$k}}", $v, $path);
                            return '/'.$url;
                        }
                    }else{
                        return "/" .$path;
                    }
                }
            }
        }
     }

}