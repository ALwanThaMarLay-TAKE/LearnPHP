<?php

namespace Libs\Database;

use PDO;
use PDOException;

class MYSQL
{
    private $dbHost;
    private $dbUser;
    private $dbName;
    private $dbPassword;
    private $db;

    public function __construct(
        $dbHost = "localhost",
        $dbUser = "root",
        $dbName = "project",
        $dbPassword = ""
    ) {
        $this->dbHost = $dbHost;
        $this->dbUser = $dbUser;
        $this->dbName = $dbName;
        $this->dbPassword = $dbPassword;
        $this->db = null;
    }
    public function connect()
    {
        try {
            $this->db = new PDO("mysql:host=$this->dbHost;dbname=$this->dbName", $this->dbUser, $this->dbPassword, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            ]);
            return $this->db;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}
