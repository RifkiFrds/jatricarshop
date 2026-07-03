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
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
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
