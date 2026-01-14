<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $pdo = DB::connection()->getPdo();
    echo "SUCCESS: Connected to " . $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) . PHP_EOL;
    echo "Database: " . config('database.connections.pgsql.database') . PHP_EOL;
    echo "Host: " . config('database.connections.pgsql.host') . PHP_EOL;
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . PHP_EOL;
}