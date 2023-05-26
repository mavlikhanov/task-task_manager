<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Actions\TaskStatusUpdateAction;
use bootstrap\Request;
use system\Api\HttpInterface;
use system\App\AbstractController;

class TaskStatusUpdateController extends AbstractController
{
    public function update(Request $request): bool|string
    {
        $action = new TaskStatusUpdateAction();
        $result = $action->run($request->toArray());
        $statusCode = HttpInterface::ACCEPTED;
        if (is_array($result)) {
            $statusCode = HttpInterface::NOT_ACCEPTABLE;
        }
        return $this->json(['result' => $result], $statusCode);
    }
}
