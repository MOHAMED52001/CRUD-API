<?php

class Database
{

    //db props 
    private $host = 'localhost';
    private $dbname = 'todo';
    private $user = 'mohamed';
    private $passwd = '123456';
    private $conn;

    //Db Connect
    public function Connect()
    {
        $this->conn = null;

        try {
            //Connection string
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
            //Create PDO instance
            $this->conn = new PDO($dsn, $this->user, $this->passwd);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }

        return $this->conn;
    }
}
