<?php

namespace App\Config;


class MySQLConnector
{
    private $pdo;
    public function __construct()
    {
        $dsn = 'mysql:host=127.0.0.1;dbname=FirstApp';
        $username = 'root';
        $password = 'root';
        try {
            $this->pdo = new \PDO($dsn, $username, $password);
        } catch(\PDOException $ex) {
            die("Соединение с базой данных отсутствует.\n".$ex->getMessage());
        }
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }
    public function getPdo()
    {
        return $this->pdo;
    }
}