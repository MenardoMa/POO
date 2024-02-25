<?php

namespace Router;

class Route
{
    private $path;
    private $callable;
    private $matches;

    public function __construct($path, $callable)
    {
        $this->path = trim($path, '/');
        $this->callable = $callable;
    }

    public function match(string $url)
    {
        $url = trim($url, '/');
        $path = preg_replace("#:([\w]+)#", "([^/]+)", $this->path);

        /**
         * l'ajout de i pe pour prendre le url typée le majuscule sera 
         * pris en compte
         */

        $regex = "#^$path$#i";
        
        if(!preg_match($regex, $url, $matches)){
            
            return false;
            
        }

        /**
         * supprime juste la premiere partie du table matches
         * c.a.d l'index 0
         */

        array_shift($matches);
        $this->matches = $matches;
        return true;

    }

    public function call()
    {
        if(is_callable($this->callable)){
        
            return call_user_func_array($this->callable, $this->matches);
        
        }
    }

}