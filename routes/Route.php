<?php

namespace Routes;

use Database\Database;

class Route
{
    private string $path;
    private string $action;
    private array  $matches;
    private array  $params;
    private array  $routeName = [];

    public function __construct(string $path, string $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;

    }

    public function match(string $url)
    {
        $url = trim($url, '/');
        $path = preg_replace_callback("#({[\w]+})#", [$this, 'paramMatch'], $this->path);
        $pathTmatch = "#^$path$#i"; 

        if(!preg_match($pathTmatch, $url, $matches)){

            return false;

        }

        array_shift($matches);
        $this->matches = $matches;
        return true;

    }

    public function name(string $name = null)
    {
        $this->routeName[$name] = $this->path;
        return $this->routeName;
    }

    public function where($param, $regex)
    {
        $this->params[$param] = str_replace("(", "(?:", $regex);
        return $this;
    }

    public function paramMatch($match)
    {
        if(isset($this->params[$match[1]])){    
            return '('. $this->params[$match[1]] .')';
        }else{
            return "([^/]+)";
        }
    }

    public function execute()
    {
        $param = explode("@", $this->action);
        $controller = new $param[0](new Database("comments", "127.0.0.1", "root", "" ));
        $method     = $param[1];

        // return isset($this->matches[0]) ? 
        // $controller->$method($this->matches[0]) : $controller->$method();

        return call_user_func_array([$controller, $method], $this->matches);

    }
}