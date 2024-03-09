<?php

namespace Routes;

use Database\database;

class Route
{
    private string $path;
    private $action;
    private array $matches;
    private array $params = [];

    public function __construct(string $path, string|callable $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function match(string $url)
    {
        $url = trim($url, '/');
        $path = preg_replace_callback("#({[\w]+})#", [$this, 'paramMatch'], $this->path);
        $regex = "#^$path$#i";

        if(!preg_match($regex, $url, $matches)){
            return false;
        }

        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    public function where($param, $regex)
    {
        $this->params[$param] = str_replace('(', '(?:', $regex);
        return $this->params;
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
        
        if(is_string($this->action))
        {
            $params = explode("@", $this->action);
            $controller = new $params[0](new database('test', "127.0.0.1", "root", ""));
            $method = $params[1];

            return isset($this->matches[0]) ? $controller->$method($this->matches[0]) :  $controller->$method();

        }else{

            return call_user_func_array($this->action, $this->matches);
        }
    }
}