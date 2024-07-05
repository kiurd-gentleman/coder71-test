<?php

namespace App\Models;

class User
{
    protected $table = 'users';

    public static function create($data)
    {
        $sql = "insert into " . self::$table_name . " set first_name=:first_name, last_name=:last_name, email=:email, age=:age, country=:country, created_at=NOW(), updated_at=NOW()";

        return DB::query($sql, $data)->run();
    }

}