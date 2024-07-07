<?php

namespace App\Models;

use App\Core\DB;

class ProductReview
{
    public static string $table_name = 'product_reviews';

    public static function create($data)
    {
        $sql = "insert into " . self::$table_name . " set product_id=:product_id, user_id=:user_id, rating=:rating, review=:review, created_at=NOW(), updated_at=NOW()";

        return DB::query($sql, $data)->run();

    }


}