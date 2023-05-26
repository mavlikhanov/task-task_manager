<?php
declare(strict_types=1);

namespace App\Controllers;

use system\App\AbstractController;

class LogoutController extends AbstractController
{
    public function logout()
    {
        unset($_SESSION['admin']);
        $this->response('/');
    }
}
