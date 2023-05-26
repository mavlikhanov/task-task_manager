<?php
declare(strict_types=1);

namespace bootstrap;

class Register
{
    private static $register = [];

    public static function set(string $key, mixed $value): void
    {
        self::$register[$key] = $value;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        if (isset(self::$register[$key])) {
            return self::$register[$key];
        }
        return $default;
    }

    public static function has(string $key): bool
    {
        return isset(self::$register[$key]);
    }

    public static function remove(string $key): void
    {
        unset(self::$register[$key]);
    }

    public static function clean(): void
    {
        self::$register = [];
    }
}
