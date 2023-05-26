<?php
declare(strict_types=1);

namespace App\Actions;

use App\Models\AdminUser;
use App\Repositories\AdminRepository;
use App\Validators\AuthorizationValidator;
use system\App\Admin;

class AuthorizationAction
{
    public function run(array $requestData): array|AdminUser
    {
        $validator = new AuthorizationValidator();
        $resultValidation = $validator->validate($requestData);
        if (is_array($resultValidation)) {
            return $resultValidation;
        }
        $login = $requestData['login'];
        $password = md5($requestData['password']);
        $repository = new AdminRepository();
        $admin = $repository->getByLoginAndPassword($login, $password);
        if (!$admin) {
            return [
                'login' => 'Login or password not correct'
            ];
        }
        $_SESSION['admin'] = serialize(new Admin($admin));
        return $admin;
    }
}
