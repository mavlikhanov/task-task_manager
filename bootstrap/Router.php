<?php
declare(strict_types=1);

namespace bootstrap;

use Exception;
use system\RouteMatcher;

class Router
{
    private Request $request;
    private RouteMatcher $routeMatcher;

    public function __construct()
    {
        $this->request = new Request();
        $this->routeMatcher = new RouteMatcher();
    }

    public function resolve(): mixed
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();
        try {
            $actionData = $this->routeMatcher->match($path, $method);
            if (!class_exists($actionData[0])) {
                throw new Exception("Class: '{$actionData[0]}' doesnt exist");
            }
            $controller = new $actionData[0];
            if (!method_exists($controller, $actionData[1])) {
                throw new Exception("Method: '{$actionData[1]}' doesnt exist");
            }
            return $controller->{$actionData[1]}($this->request);
        } catch (Exception $exception) {
            exit($exception->getMessage());
        }
    }
}
