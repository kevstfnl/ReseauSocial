<?php

class Router
{
    private array $controllers = [];

    public function register(Controller $controllers)
    {
        array_push($this->controllers, $controllers);
    }

    public function init()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $path = parse_url($requestUri, PHP_URL_PATH);
        
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->controllers as $controller) {
            if ($controller instanceof Controller) {
                if ($controller->getPath() == $path) {
                    $controller->call($requestMethod);
                    return;
                }
            }
        }
        include_once("../views/404.php");
    }
}
