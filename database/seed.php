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

try {
    echo "Running seeders...\n";
    
    // Require and run each seeder script in seeders directory
    $seeders = glob(__DIR__ . '/seeders/*.php');
    foreach ($seeders as $seeder) {
        echo "Seeding with: " . basename($seeder) . "\n";
        require_once $seeder;
    }
    
    echo "Seeding successfully completed!\n";
} catch (\Exception $e) {
    echo "Error running seeders: " . $e->getMessage() . "\n";
    exit(1);
}
