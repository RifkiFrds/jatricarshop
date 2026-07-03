<?php

namespace App\Core;

class Router {
    private $routes = [];

    public function get($route, $action) {
        $this->addRoute('GET', $route, $action);
    }

    public function post($route, $action) {
        $this->addRoute('POST', $route, $action);
    }

    private function addRoute($method, $route, $action) {
        $trimmedRoute = trim($route, '/');
        // Convert route parameters {param} to named regex groups
        $pattern = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $trimmedRoute);
        $pattern = '#^' . ($pattern === '' ? '' : $pattern) . '$#';
        
        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'action' => $action
        ];
    }

    public function handle($requestUri, $requestMethod) {
        $path = parse_url($requestUri, PHP_URL_PATH);
        
        // Strip leading/trailing slashes and get route key
        // If url is passed via query param (e.g. rewrite) use it, otherwise fall back to path
        $url = $_GET['url'] ?? trim($path, '/');
        $url = trim($url, '/');

        // Handle case where project is hosted in subfolder
        // E.g. /jatricarshop/public/index.php -> if url starts with public/ index, remove it
        if (strpos($url, 'public/') === 0) {
            $url = substr($url, 7);
        }
        $url = trim($url, '/');

        foreach ($this->routes as $route) {
            if ($route['method'] !== $requestMethod) {
                continue;
            }

            if (preg_match($route['pattern'], $url, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                
                $action = $route['action'];
                if (is_array($action)) {
                    $controllerName = $action[0];
                    $methodName = $action[1];

                    if (class_exists($controllerName)) {
                        $controller = new $controllerName();
                        if (method_exists($controller, $methodName)) {
                            call_user_func_array([$controller, $methodName], $params);
                            return;
                        }
                    }
                }
                
                if (is_callable($action)) {
                    call_user_func_array($action, $params);
                    return;
                }
            }
        }

        http_response_code(404);
        echo "<h1>404 - Page Not Found</h1><p>The page you are looking for does not exist.</p>";
    }
}
