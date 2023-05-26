<?php
declare(strict_types=1);

namespace system;

use bootstrap\Register;
use system\Api\HttpInterface;
use system\Exceptions\HttpMethodNotAllow;
use system\Exceptions\HttpNotFound;

class RouteMatcher
{
    public function match(string $urlPath, string $method): array
    {
        if (!Register::has("route.$urlPath")) {
            throw new HttpNotFound(
                HttpInterface::CODES[HttpInterface::NOT_FOUND],
                HttpInterface::NOT_FOUND
            );
        }
        $data = Register::get("route.$urlPath");
        if (!in_array($method, $data['allow_methods'])) {
            throw new HttpMethodNotAllow(
                HttpInterface::CODES[HttpInterface::METHOD_NOT_ALLOWED],
                HttpInterface::METHOD_NOT_ALLOWED
            );
        }
        return $data['action'];
    }
}
