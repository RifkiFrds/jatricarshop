<?php

require_once __DIR__ . '/../app/Core/Database.php';

// Setup autoloading
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) require $file;
});

use App\Core\Database;

try {
    echo "Checking/creating database...\n";
    $config = require __DIR__ . '/../config/database.php';
    $dsn_no_db = sprintf("mysql:host=%s;port=%s;charset=utf8mb4", $config['host'], $config['port']);
    $pdo_temp = new PDO($dsn_no_db, $config['username'], $config['password'], [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    $pdo_temp->exec(sprintf("CREATE DATABASE IF NOT EXISTS `%s` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci", $config['database']));
    
    echo "Running migrations...\n";
    $db = Database::getInstance()->getConnection();
    
    // Read the SQL migration file
    $sql = file_get_contents(__DIR__ . '/migrations/01_create_tables.sql');
    
    // Execute SQL
    $db->exec($sql);
    
    echo "Migrations successfully completed!\n";
} catch (\Exception $e) {
    echo "Error executing migrations: " . $e->getMessage() . "\n";
    exit(1);
}
