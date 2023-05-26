<?php
declare(strict_types=1);

namespace bootstrap;

class Request extends AbstractRequest
{
    private int $page = 1;
    private array $get = [];

    public function getPath(): string
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if (isset($_GET['page'])) {
            $this->page = (int)addslashes($_GET['page']);
            unset($_GET['page']);
        }

        if (isset($_GET)) {
            $this->get = $_GET;
        }

        if (empty($position)) {
            return $path;
        }

        return substr($path, 0, $position);
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function get(): array
    {
        return $this->get;
    }

    public function getPage(): int
    {
        return $this->page;
    }
}
