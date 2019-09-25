<?php

class Database
{
    protected $conn = null;

    public function connect()
    {
        $username = "root";
        $password = "";

        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=dataDb", $username, $password);

            // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function close()
    {
        $this->conn = null;
    }
}


