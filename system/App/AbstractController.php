<?php
declare(strict_types=1);

namespace system\App;

use system\Api\HttpInterface;

abstract class AbstractController
{
    protected string $layout = '';

    protected function view(string $templateName, array $data = []): string
    {
        $view = new View();
        $page = new Page($this->layout, $templateName, $data);
        return $view->render($page);
    }

    protected function errorResponse(string $url, mixed $message, int $code = HttpInterface::MOVED_PERMANENTLY): void
    {
        $_SESSION['errorMessage'] = $message;
        header("Location: $url", true, $code);
        exit();
    }

    protected function response(string $url, string $message = '', int $code = HttpInterface::MOVED_PERMANENTLY): void
    {
        if (!empty($message)) {
            $_SESSION['message'] = $message;
        }
        header("Location: $url", true, $code);
        exit();
    }

    protected function json(array $responseData = [], int $statusCode = HttpInterface::OK): bool|string
    {
        http_response_code($statusCode);
        return json_encode($responseData);
    }
}
