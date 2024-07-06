<?php

use App\Core\Core;

$code = Core::bind('config', require 'config/database.php');

//try {
//    Core::bind('database',
//        new QueryBuilder(
//            DB::make(Core::get('config')['connections'][Core::get('config')['connections']])
//        )
//    );
//} catch (Exception $e) {
//    die($e->getMessage());
//}

