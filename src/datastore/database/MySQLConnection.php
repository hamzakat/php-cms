<?php

class MySQLConnection
{

    private $pdo;
    private $result;

    private $host;
    private $port;
    private $database;
    private $user;
    private $password;

    function __construct($host, $port, $database, $user, $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;

        $this->connect();
    }

    function connect()
    {
        $connectionString = "mysql:host=" . $this->host . ";port=" . $this->port . ";charset=utf8;dbname=" . $this->database;
        try {
            $this->pdo = new PDO(
                $connectionString,
                $this->user,
                $this->password
            );
        } catch (\PDOException $e) {
            echo "Cannot connect to DB!";
        }
    }

    function getPDO()
    {
        return $this->pdo;
    }
}
