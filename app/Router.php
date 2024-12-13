<?php

namespace App;

class Router {

    private $routes = [];

    public function add($method, $route, $callback) {
        $this->routes[] = [ 'method' => $method, 'route' => $route, 'callback' => $callback ];
    }

    public function dispatch($requestUrl) {
        foreach ($this->routes as $route) {
            // Comparamos el método HTTP
            if ($_SERVER['REQUEST_METHOD'] === $route['method']) {
                
                $pattern = '@^' . preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_]+)', $route['route']) . '$@';
                
                if (preg_match($pattern, $requestUrl, $matches)) {
                    
                    $params = [];
                    foreach ($matches as $key => $value) {
                        if (!is_int($key)) {
                            $params[$key] = $value;
                        }
                    }

                    return call_user_func_array($route['callback'], $params);
                }
            }
        }
    }
}

?>