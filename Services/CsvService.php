<?php

namespace TestCli\Services;

class CsvService
{
    public function parse(bool $dryRun = false): void
    {
        $options = getopt("u:p:h:", ["file:", "dry_run", "create_table"]);
        $filePath = $options["file"] ?? "users.csv";
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        $row = 1;
        if (
            ($file = fopen($filePath, "r")) !== FALSE
            && $extension == 'csv'
        ) {
            while (($data = fgetcsv($file)) !== FALSE) {
                $name = ucfirst(strtolower($data[0]));
                $surname = ucfirst(strtolower($data[1]));
                $email = strtolower($data[2]);

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
