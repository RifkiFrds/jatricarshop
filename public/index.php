<?php

// Start session with cross-subdomain support
if (session_status() === PHP_SESSION_NONE) {
    $hostPart = explode(':', $_SERVER['HTTP_HOST'] ?? '')[0];

    if (str_ends_with($hostPart, '.jatri.my.id') || $hostPart === 'jatri.my.id') {
        session_set_cookie_params([
            'lifetime' => 0,
            'path' => '/',
            'domain' => '.jatri.my.id',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
    }

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

// Load routes dynamically based on subdomain host
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
if (strpos($host, 'admin.') === 0) {
    $router = require __DIR__ . '/../routes/admin.php';
} else {
    $router = require __DIR__ . '/../routes/web.php';
}

// Dispatch route
$router->handle($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
