<?php

if (!function_exists('view')) {
    function view($viewName, $data = []) {
        extract($data);
        $viewFile = __DIR__ . '/../views/' . $viewName . '.php';
        if (file_exists($viewFile)) {
            require $viewFile;
        } else {
            echo "View file not found: " . $viewName;
        }
    }
}

if (!function_exists('base_url')) {
    function base_url($path = '') {
        $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || 
                   (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
                   (isset($_SERVER['HTTP_X_FORWARDED_PORT']) && $_SERVER['HTTP_X_FORWARDED_PORT'] === '443');
        $protocol = $isHttps ? "https" : "http";
        $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
        
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $baseDir = str_replace('/index.php', '', $scriptName);
        
        return $protocol . "://" . $host . $baseDir . ($path ? '/' . trim($path, '/') : '');
    }
}

if (!function_exists('redirect')) {
    function redirect($url) {
        header('Location: ' . base_url($url));
        exit;
    }
}
