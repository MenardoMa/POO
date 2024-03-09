<?php

namespace App\http\Controller;

use Database\database;

abstract class Controller
{
    private $db;

    public function __construct(database $db)
    {
        $this->db = $db;
    }

    public function view($path, $params = [])
    {
        $path = str_replace(".", "/", $path);

        ob_start();
        require VIEWS ."views/".$path.'.php';
        $content = ob_get_clean();
        require VIEWS .'views/layout/layout.php';

    }

    public function getBD()
    {
        return $this->db->getPDO();
    }

}