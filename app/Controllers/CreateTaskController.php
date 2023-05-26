<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Actions\CreateTaskAction;
use bootstrap\Request;
use system\App\AbstractController;

class CreateTaskController extends AbstractController
{
    public function create(Request $request)
    {
        $action = new CreateTaskAction();
        $result = $action->run($request->toArray());
        if (is_array($result)) {
            $this->errorResponse('/', $result);
        }
        $this->response('/', 'Task has been created');
    }
}
