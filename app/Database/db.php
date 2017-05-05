<?php

namespace App\Database;

use PDO;

Class DB{

    private $db;
    private $connection;


    /**
     * DB constructor.
     */
    public function __construct()
    {
        $this->db = "app/Database/database.sqlite";
        $this->connection = new PDO("sqlite:".$this->db);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}