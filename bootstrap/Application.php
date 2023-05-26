<?php
declare(strict_types=1);

namespace bootstrap;

class Application
{
    private Router $router;

    public function __construct()
    {
        DB::getConnection();
        $this->router = new Router();
    }

    public function run(): mixed
    {
        return $this->router->resolve();
    }
}
