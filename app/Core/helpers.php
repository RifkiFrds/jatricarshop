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
        
        $currentHost = $_SERVER['HTTP_HOST'] ?? 'localhost';
        
        // Remove admin. subdomain if currently on it for base_url
        if (strpos($currentHost, 'admin.') === 0) {
            $host = substr($currentHost, 6);
        } else {
            $host = $currentHost;
        }
        
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $baseDir = str_replace('/index.php', '', $scriptName);
        $baseDir = trim($baseDir, '/');
        $baseDir = $baseDir ? '/' . $baseDir : '';
        
        $path = trim($path, '/');
        return $protocol . "://" . $host . $baseDir . ($path !== '' ? '/' . $path : '');
    }
}

if (!function_exists('admin_url')) {
    function admin_url($path = '') {
        $isHttps = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || 
                   (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') ||
                   (isset($_SERVER['HTTP_X_FORWARDED_PORT']) && $_SERVER['HTTP_X_FORWARDED_PORT'] === '443');
        $protocol = $isHttps ? "https" : "http";
        
        $currentHost = $_SERVER['HTTP_HOST'] ?? 'localhost';
        
        // Add admin. subdomain if not present
        if (strpos($currentHost, 'admin.') !== 0 && $currentHost !== 'localhost') {
            $host = 'admin.' . ltrim($currentHost, 'www.');
        } else {
            $host = $currentHost;
        }
        
        $scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
        $baseDir = str_replace('/index.php', '', $scriptName);
        $baseDir = trim($baseDir, '/');
        $baseDir = $baseDir ? '/' . $baseDir : '';
        
        $path = trim($path, '/');
        return $protocol . "://" . $host . $baseDir . ($path !== '' ? '/' . $path : '');
    }
}

if (!function_exists('redirect')) {
    function redirect($url, $isAdmin = false) {
        if (strpos($url, 'http://') !== 0 && strpos($url, 'https://') !== 0) {
            $target = $isAdmin ? admin_url($url) : base_url($url);
            header('Location: ' . $target);
        } else {
            header('Location: ' . $url);
        }
        exit;
    }
}
