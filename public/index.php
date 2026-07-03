<?php

// Start session with cross-subdomain support
if (session_status() === PHP_SESSION_NONE) {
    $host = $_SERVER['HTTP_HOST'] ?? '';
    // Strip port if present
    $hostPart = explode(':', $host)[0];
    
    // Set session cookie domain to allow sharing across subdomains (e.g. .jatri.my.id)
    if (filter_var($hostPart, FILTER_VALIDATE_IP) === false && $hostPart !== 'localhost' && substr_count($hostPart, '.') >= 2) {
        // e.g. admin.jatri.my.id or jatri.my.id -> .jatri.my.id
        // strip everything before the last two dots
        $parts = explode('.', $hostPart);
        $domain = '.' . implode('.', array_slice($parts, -2));
        ini_set('session.cookie_domain', $domain);
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
