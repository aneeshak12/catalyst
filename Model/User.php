<?php

namespace Model;

use Exception;
use TestCli\Connection\MysqlConnection;

require_once __DIR__ . '/../Connection/MysqlConnection.php';

class User
{
    protected $conn;
    protected $tableName = "users";

    public function __construct()
    {
        $this->conn = MysqlConnection::$conn;
    }

    public function insert(array $data)
    {
        try {
            if (!$this->existTable()) {
                die("Table {$this->tableName} not found. Please run script with options --create_table.");
            }

            $sql = "INSERT INTO {$this->tableName} (name, surname, email) VALUES (?, ?, ?) 
                ON DUPLICATE KEY UPDATE name = VALUES(name), surname = VALUES(surname)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('sss', $data["name"], $data["surname"], $data["email"]);
            $stmt->execute();
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function migrate()
    {
        try {
            $sql = "CREATE TABLE If Not Exists {$this->tableName} (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) NOT NULL,
                surname VARCHAR(30) NOT NULL,
                email VARCHAR(50) UNIQUE
                )";

            $this->conn->query($sql);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function existTable(): bool
    {
        $existQuery = "SHOW TABLES LIKE '{$this->tableName}'";
        $result = $this->conn->query($existQuery);

        return $result->num_rows > 0;
    }
}
