<?php
declare(strict_types=1);

namespace bootstrap;

class Route
{
    public static function get(string $routeName, array $action): void
    {
        $self = new self;
        $self->setRoute($routeName, $action, ['get']);
    }

    public static function post(string $routeName, array $action): void
    {
        $self = new self;
        $self->setRoute($routeName, $action, ['post']);
    }

    private function setRoute(string $routeName, array $action, array $allowMethods): void
    {
        $data = [
            'action' => $action,
            'allow_methods' => $allowMethods,
        ];
        Register::set("route.$routeName", $data);
    }
}
