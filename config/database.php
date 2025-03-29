<?php

class Database {
    private string $host = 'localhost';
    private string $db_name = 'db_app';
    private string $username = 'root';
    private string $password = 'root';
    private ?PDO $conn = null;

    public function getConnection(): ?PDO {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]);
            } catch (PDOException $exception) {
                error_log("Database connection error: " . $exception->getMessage());
                return null;
            }
        }
        return $this->conn;
    }
}



