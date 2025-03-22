<?php

namespace db;
use PDO;
use PDOException;

class Connection
{
    private string $host_name;
    private string $db_name;
    private string $user_name;
    private string $password;
    private $conn = null;
    public function __construct(string $host_name, string $db_name, string $user_name, string $password)
    {
        $this->host_name = $host_name;
        $this->db_name = $db_name;
        $this->user_name = $user_name;
        $this->password = $password;

        $this->connect();
    }


    public function getConnection(): ?PDO
    {
        return $this->conn;
    }


    private function connect(): void
    {
        try {

            $this->conn = new PDO("mysql:host=$this->host_name;dbname=$this->db_name;charset=utf8", $this->user_name, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Connection Failed: " . $e->getMessage());
        }
    }

    public function close(int $status):void {
        $this->conn = null;
        exit($status);
    }
}
