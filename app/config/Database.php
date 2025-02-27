<?php

class Database {
    private $host = 'localhost';
    private $db_name = 'kabum';
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Conexão falhou: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
