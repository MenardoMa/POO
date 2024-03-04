<?php

namespace App\Controller;

use Database\Database;

abstract class Controller
{
    private $extens = ".php";
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function views($path, $params = null)
    {

        $path = str_replace(".", "/", $path);
        ob_start();
        require VIEWS . $path .$this->extens;
        $content = ob_get_clean();
        require VIEWS . 'layout' .$this->extens; 

    }

    public function routename($path, $params = [])
    {
        $routes->url('posts.show');
    }

    public function getDb()
    {
        return $this->db->getPDO();
    }

}