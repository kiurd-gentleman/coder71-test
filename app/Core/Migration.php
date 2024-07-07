<?php

namespace App\Core;

class Migration
{
    public function doMigrations()
    {
        $files = scandir('migrations');
        echo '<pre>';
        var_dump($files);

        foreach ($files as $migration) {
            if ($migration === '.' || $migration === '..') {
                continue;
            }
            require_once 'migrations/' . $migration;
            $className = pathinfo($migration, PATHINFO_FILENAME);
            $className = "\\migrations\\$className";
            $instance = new $className();
            $instance->up();
        }
    }

}