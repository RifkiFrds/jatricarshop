<?php

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Simple autoloading for App namespace
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../app/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

// Require global helper functions
require_once __DIR__ . '/../app/Core/helpers.php';

// Load routes
$router = require __DIR__ . '/../routes/web.php';

// Dispatch route
$router->handle($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
