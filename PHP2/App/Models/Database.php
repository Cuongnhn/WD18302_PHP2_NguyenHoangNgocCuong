<?php

namespace App\Models;

use PDO;
use PDOException;
use mysqli;
use Exception;
use Dotenv\Dotenv;
require 'vendor/autoload.php';

class Database
{
    use QueryBuilder;

    private static $dbHost;
    private static $dbName;
    private static $dbUser;
    private static $dbPassword;
    private static $dbPort;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        // Sử dụng các biến môi trường
        self::$dbHost = $_ENV['DB_HOST'] ?? 'localhost';
        self::$dbName = $_ENV['DB_DATABASE'] ?? 'management';
        self::$dbUser = $_ENV['DB_USERNAME'] ?? 'root';
        self::$dbPassword = $_ENV['DB_PASSWORD'] ?? 'mysql';
        self::$dbPort = $_ENV['DB_PORT'] ?? '3306';
    }

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