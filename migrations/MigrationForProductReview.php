<?php

namespace migrations;

use App\Core\DB;
use App\Core\Request;

class MigrationForProductReview
{

    public function up()
    {
        $query = "CREATE TABLE product_reviews (
                id INT AUTO_INCREMENT PRIMARY KEY,
                product_id INT NOT NULL,
                user_id INT NOT NULL,
                rating INT NOT NULL,
                review TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";

        DB::query($query)->run();
    }

    public function down()
    {
        $query = "DROP TABLE product_reviews;";
        DB::query($query)->run();
    }

}