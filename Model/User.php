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

    public function migrate()
    {
        try {
            $sql = "CREATE TABLE If Not Exists {$this->tableName} (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30) NOT NULL,
                surname VARCHAR(30) NOT NULL,
                email VARCHAR(50)
                )";

            $this->conn->query($sql);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }
}
