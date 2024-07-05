<?php

namespace App\Core;
use PDO;

class DB
{
    private static $host = ;
    private static $db_name = DB_NAME;
    private static $username = DB_USER;
    private static $password = DB_PASSWORD;

    private static $statement;
    private static $params;
    private static $conn;

    public static function getConnection()
    {
        $conn = null;

        try {
            $conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$db_name, self::$username, self::$password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("set names utf8");
        } catch(\PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        self::$conn = $conn;
        return $conn;
    }

    public static function query($sql, $data = null)
    {
        // Get Connection
        $db = self::getConnection();

        // Prepare query statement
        $stmt = $db->prepare($sql);

        $params = array();

        if ($data) {
            // Sanitize
            foreach ($data as $key => $value) {
                if ($value) {
                    $params[$key] = htmlspecialchars(strip_tags($value));
                }
            }
        }

        self::$statement = $stmt;
        self::$params = $params;

        return new static();
    }

    public static function run()
    {
        try {
            return self::$statement->execute(self::$params);
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }


}