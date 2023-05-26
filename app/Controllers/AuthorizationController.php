<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Actions\AuthorizationAction;
use bootstrap\Request;
use system\App\AbstractController;

class AuthorizationController extends AbstractController
{
    public function login(Request $request)
    {
        $action = new AuthorizationAction();
        $result = $action->run($request->toArray());
        if (is_array($result)) {
            $this->errorResponse('/', $result);
        }
        $this->response('/');
    }
}
