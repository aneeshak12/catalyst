<?php

namespace TestCli\Connection;

use Exception;

final class MysqlConnection
{
    public static $conn;

    public function __construct()
    {
        $this->connect();
    }

    public function connect(): void
    {
        try {
            $databaseName = "Catalyst";
            $options = getopt("u:p:h:", ["file:", "dry_run", "create_table"]);

            $servername = $options["h"] ?? "127.0.0.1:3306";
            $username = $options["u"] ?? "root";
            $password = $options["p"] ?? "";

            self::$conn = mysqli_connect($servername, $username, $password);

            $sqlCreateDb = "CREATE DATABASE IF NOT EXISTS {$databaseName}";
            mysqli_query(self::$conn, $sqlCreateDb);

            mysqli_select_db(self::$conn, $databaseName);
        } catch (Exception $exception) {
            die("Couldn't connect to database. Please check -u -p and -h options from command");
        }
    }

    public function exists(array $options, string $key): bool
    {
        if (!isset($options[$key])) {
            die("Please input valid data for options 'h', 'u', 'p'");
        }

        return true;
    }
}
