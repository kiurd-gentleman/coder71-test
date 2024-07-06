<?php

namespace migrations;

use App\Core\DB;

class MigrationForUser
{
    public function up()
    {
        $query = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(255) NOT NULL,
                name VARCHAR(255) NOT NULL,
                password VARCHAR(512) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )  ENGINE=INNODB;";

        DB::query($query)->run();
    }

    public function down()
    {
        $query = "DROP TABLE users;";
        DB::query($query)->run();
    }

}