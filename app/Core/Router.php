<?php
namespace App\Core;

class Router {
    private $routes = [];

    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    public function dispatch($uri, $method) {
        // Remove query string
        $uri = strtok($uri, '?');
        
        // Ensure uri starts with /
        if ($uri === '') {
            $uri = '/';
        }
        
        if (isset($this->routes[$method][$uri])) {
            return call_user_func($this->routes[$method][$uri]);
        }
        
        // If route not found, show 404
        http_response_code(404);
        echo "404 - Page not found";
    }
}