<?php
declare(strict_types=1);

namespace bootstrap;

abstract class AbstractRequest
{
    protected array $request = [];

    public function __construct()
    {
        if ($this->isPost()) {
            $this->request = $_POST;
        }
    }

    public function isPost(): bool
    {
        return isset($_POST);
    }

    public function toArray(): array
    {
        return $this->request;
    }

    public function __get(string $key)
    {
        if (array_key_exists($key, $this->request)) {
            return $this->request[$key];
        }
        return null;
    }
}
