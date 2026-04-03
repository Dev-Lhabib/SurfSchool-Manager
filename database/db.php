<?php

class Database {
    private $host = "localhost";
    private $port = "3307";
    private $dbname = "surfschool";
    private $username = "root";
    private $password = "";
    private $pdo;

    public function connect() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            return $this->pdo;

        } catch (PDOException $e) {
            error_log($e->getMessage());
            die("❌ Database connection failed.");
        }
    }


}


