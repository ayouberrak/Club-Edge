<?php
namespace Core;

class Router {
    protected $routes = [];

    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback) {
        $this->routes['POST'][$path] = $callback;
    }

    public function dispatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        $path = str_replace('\\', '/', $path);
        
        $scriptName = $_SERVER['SCRIPT_NAME'];
        $scriptDir = dirname($scriptName);
        $scriptDir = str_replace('\\', '/', $scriptDir);

        if (strpos($path, $scriptDir) === 0 && $scriptDir !== '/') {
            $path = substr($path, strlen($scriptDir));
        }
        elseif (strpos($path, dirname($scriptDir)) === 0 && dirname($scriptDir) !== '/') {
            $path = substr($path, strlen(dirname($scriptDir)));
        }

        if ($path === '' || $path[0] !== '/') {
            $path = '/' . $path;
        }



        

        $callback = false;
        $params=[];
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $route => $cb) {
                $routePattern = preg_replace('/\{[a-zA-Z_][a-zA-Z0-9_]*\}/', '([a-zA-Z0-9_\-]+)', $route);
                $routePattern = str_replace('/', '\/', $routePattern);
                if (preg_match('/^' . $routePattern . '$/', $path, $matches)) {
                    array_shift($matches);
                    $params = $matches;
                    $callback = $cb;
                    break;
                }
            }
        }



        if ($callback) {
            if (is_array($callback)) {
                $controller = new $callback[0]();
                $method = $callback[1];
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    return $controller->$method($_POST , ...$params);
                } else {
                    return $controller->$method(...$params); // GET
                }
            }
            call_user_func($callback);
        } else {
            http_response_code(404);
            echo "<div style='font-family:monospace; background:#f8d7da; padding:20px; color:#721c24;'>";
            echo "<strong>404 Not Found</strong><br>";
            echo "The requested URL was not found on this server.<br><br>";
            echo "<strong>Debug Info:</strong><br>";
            echo "Method: $method<br>";
            echo "Raw URI: " . $_SERVER['REQUEST_URI'] . "<br>";
            echo "Calculated Path: $path<br>";
            echo "Script Dir: $scriptDir<br>";
            echo "Available Routes: <pre>" . print_r(array_keys($this->routes[$method] ?? []), true) . "</pre>";
            echo "</div>";
        }
    }
}
