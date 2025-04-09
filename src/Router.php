<?php

namespace Api;

use Api\Http\Request;
use Api\Controllers\UserController;

class Router {
    
    protected Request $request;
    protected array $routes = [];
    
    public function __construct(Request $request){
        $this->request = $request;
    }

    function addRoute(string $method,string $path, callable $action){
        $this->routes[$method][$path]=$action;
        return $this;
    }
    
    private function matchUri(string $routePath, string $requestUri, &$params): bool
    {
        $pattern = preg_replace('#\{(\w+)\}#', '(?P<$1>[^/]+)', $routePath);
        $pattern = "#^" . $pattern . "$#";

        if (preg_match($pattern, $requestUri, $matches)) {
            $params = array_filter($matches, fn($key) => is_string($key), ARRAY_FILTER_USE_KEY);
            return true;
        }

        return false;
    }
    
    function dispacth(){
        
        $routes = include 'routes.php';

        //comprobar si path existe en rutas
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        foreach ($routes as $route) {
            try{
                if ($this->matchUri($route['path'],$path,$params) && $route['method'] == $method) {
                    [$controllerClass,$action] = $route['handler'];
                    $controller = new $controllerClass($this->request);
                    call_user_func_array([$controller,$action],$params ?? []);
                    return;
                }
            }catch (Exception $e){
                echo "Hay un error : " . $e->getMessage();
                return;
            }
        }
        
    }

}