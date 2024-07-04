<?php

require 'vendor/autoload.php';

/**
 * Require routes file
 */
require 'routes/web.php';

/**
 * Require configuration file
 */
require 'config/database.php';

/**
 * Handle routes from Route helper class
 */
use App\Core\Route;
Route::handle($_SERVER['PHP_SELF']);