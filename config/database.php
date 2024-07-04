<?php
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

return [
    'default' => $_ENV['DB_CONNECTION'],
    'connections' => [
        'mysql' => [
            'driver' => 'mysql',
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'database' => $_ENV['DB_DATABASE'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
        'pgsql' => [
            'driver' => 'pgsql',
            'host' => $_ENV['DB_HOST'],
            'port' => $_ENV['DB_PORT'],
            'database' => $_ENV['DB_DATABASE'],
            'username' => $_ENV['DB_USERNAME'],
            'password' => $_ENV['DB_PASSWORD'],
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],
    ],
//    'migrations' => 'migrations',
//    'redis' => [
//        'client' => $_ENV['REDIS_CLIENT'],
//        'options' => [
//            'cluster' => $_ENV['REDIS_CLUSTER'],
//            'prefix' => $_ENV['REDIS_PREFIX', Str::slug($_ENV['APP_NAME')).'_database_'],
//        ],
//        'default' => [
//            'url' => $_ENV['REDIS_URL'],
//            'host' => $_ENV['REDIS_HOST',
//            'password' => $_ENV['REDIS_PASSWORD', null],
//            'port' => $_ENV['REDIS_PORT'],
//            'database' => $_ENV['REDIS_DB'],
//        ],
//    ],
];