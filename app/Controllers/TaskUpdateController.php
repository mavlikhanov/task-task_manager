<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Actions\UpdateTaskAction;
use bootstrap\Request;
use system\App\AbstractController;

class TaskUpdateController extends AbstractController
{
    public function update(Request $request)
    {
        $action = new UpdateTaskAction();
        $result = $action->run($request->toArray());
        if (is_array($result)) {
            $this->errorResponse('/', $result);
        }
        $this->response('/', 'Task has been updated');
    }
}
