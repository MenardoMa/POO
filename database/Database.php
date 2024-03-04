<?php

namespace Database;

use PDO;

class Database
{
    private $dbname;
    private $dbhost;
    private $dbuser;
    private $dbpass;
    private $pdo;

    public function __construct($dbname, $dbhost, $dbuser, $dbpass = "")
    {
        $this->dbname = $dbname;
        $this->dbhost = $dbhost;
        $this->dbuser = $dbuser;
        $this->dbpass = $dbpass;
    }

    public function getPDO()
    {
        if(is_null($this->pdo)){

            $this->pdo = new PDO("mysql:dbname={$this->dbname};host={$this->dbhost}", $this->dbuser, $this->dbpass, [

                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8'
            ]);

        }

        try {
            return $this->pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }

}