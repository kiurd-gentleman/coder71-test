<?php

namespace App\Core;

use App\Core\Core;
use PDO;

//use App\Core\Core;

class DB
{
    private static $statement;
    private static $params;
    private static $conn;

    public static function getConnection(): ?PDO
    {
        $default = Core::get('config')['default'];
        $host = Core::get('config')['connections'][$default]['host'];
        $db_name = Core::get('config')['connections'][$default]['database'];
        $username = Core::get('config')['connections'][$default]['username'];
        $password = Core::get('config')['connections'][$default]['password'];
        $conn = null;

        try {
            $conn = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->exec("set names utf8");
        } catch (\PDOException $e) {
            echo "Connection error: " . $e->getMessage();
        }

        self::$conn = $conn;
        return $conn;
    }

    public static function query($sql, $data = null): static
    {
//        var_dump($sql, $data);
        // Get Connection
        $db = self::getConnection();

        // Prepare query statement
        $stmt = $db->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

        $params = array();

        echo '<pre>';
        var_dump($data);

        if ($data) {
            // Sanitize
            foreach ($data as $key => $value) {
                if ($value) {
                    if (is_string($value)) {
                        $params[$key] = htmlspecialchars(strip_tags($value));
                    } elseif (is_int($value)
                        || is_float($value)
                        || is_double($value)
                        || is_bool($value)
                    ) {
                        $params[$key] = $value;
                    } else {
                        $params[$key] = (int)htmlspecialchars(strip_tags($value));
                    }
                }
            }
        }
        echo '<pre>';
        var_dump($params);


        self::$statement = $stmt;
        self::$params = $params;

        echo '<pre>';
        var_dump(self::$params);

        return new static();
    }

    public static function run()
    {
        try {
            return self::$statement->execute(self::$params);
        } catch (\PDOException $e) {
            var_dump($e);

            return $e->getMessage();
        }
    }


}