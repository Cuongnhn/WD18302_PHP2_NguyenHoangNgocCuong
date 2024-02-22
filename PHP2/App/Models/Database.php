<?php

namespace App\Models;

use PDO;
use PDOException;
use mysqli;
use Exception;

class Database
{
    use QueryBuilder;

    private static $dbHost = 'localhost';

    private static $dbName = 'management';

    private static $dbUser = 'root';

    private static $dbPassword = 'mysql';

    private static $dbPort = '3306';



    public function PDO()
    {
        try {
            $conn = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$dbPassword);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function query($sql)
    {
        try {
            $statement = $this->PdO()->prepare($sql);
            $statement->execute();
            return $statement;
        } catch (Exception $ex) {
            $mess = $ex->getMessage();
            echo $mess;
        }
    }
}