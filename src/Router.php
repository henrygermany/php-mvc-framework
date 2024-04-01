<?php

namespace App;

use Exception;

class Router
{
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    /**
     * Create a new router and register all routes defined in `file`.
     * @param string $file where routes are defined
     * @return static
     */
    public static function load($file): static
    {
        $router = new static;
        require $file;
        return $router;
    }

    /**
     * Call the defined route for the given URI + METHOD combination.
     * @param $uri
     * @param $method
     * @return string
     * @throws Exception
     */
    public function callRoute($uri, $method): string
    {

        if (!array_key_exists($uri, $this->routes[$method])) {
            return $this->callAction(...$this->routes[$method]['404']);
        }

        return $this->callAction(...$this->routes[$method][$uri]);
    }

    /**
     * Register a new GET route.
     *
     * Usage:
     * ```
     * $router->get('/', [Controller::class, 'index'])
     * ```
     */
    public function get($uri, array $endpoint): void {
        $this->routes['GET'][$uri] = $endpoint;
    }

    /**
     * Register a new POST route.
     *
     * Usage:
     * ```
     * $router->post('/', [Controller::class, 'index'])
     * ```
     */
    public function post($uri, array $endpoint): void {
        $this->routes['POST'][$uri] = $endpoint;
    }

    /**
     * @throws Exception if `controller` does not exist or does not accept the given `action`
     */
    private function callAction($controller, $action): string
    {
        if(!class_exists($controller))
            throw new Exception("Controller $controller does not exist.");

        if (!method_exists($controller, $action))
            throw new Exception("Controller $controller does not accept action $action");

        return (new $controller)->$action();
    }
}