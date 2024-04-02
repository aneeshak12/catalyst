<?php

namespace TestCli\Services;

use Model\User;
use TestCli\Exceptions\InvalidEmailException;

require_once __DIR__ . '/../Exceptions/InvalidEmailException.php';
require_once __DIR__ . '/../Model/User.php';

class CsvService
{
    public function parse(bool $dryRun = false): void
    {
        $options = getopt("u:p:h:", ["file:", "dry_run", "create_table"]);
        $filePath = $options["file"] ?? "users.csv";
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        $user = new User();

        $row = 1;
        if (
            ($file = fopen($filePath, "r")) !== FALSE
            && $extension == 'csv'
        ) {
            while (($data = fgetcsv($file)) !== FALSE) {
                if ($row == 1) {
                    $row++;
                    continue;
                }

                if (!isset($data[0]) || !isset($data[1]) || !isset($data[2])) {
                    continue;
                }

                $name = ucfirst(strtolower($data[0]));
                $surname = ucfirst(strtolower($data[1]));
                $email = strtolower($data[2]);

                if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
                    throw new InvalidEmailException($email);
                }

                if (!$dryRun) {
                    $data = [
                        "name" => $name,
                        "surname" => $surname,
                        "email" => $email,
                    ];
                    $user->insert($data);
                }

                $row++;
            }
            fclose($file);

            $totalData = $row - 2;
            echo "{$totalData} users found \n";
        } else {
            die("File could not be opened.");
        }
    }
}
