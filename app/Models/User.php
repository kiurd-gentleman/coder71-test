<?php

namespace App\Models;

use App\Core\DB;

class User
{
    public static string $table_name = 'users';

    public static function create($data)
    {
        $sql = "insert into " . self::$table_name . " set first_name=:first_name, last_name=:last_name, email=:email, age=:age, country=:country, created_at=NOW(), updated_at=NOW()";

//        var_dump($sql);
        return DB::query($sql, $data)->run();
    }

}