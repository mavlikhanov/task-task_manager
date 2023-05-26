<?php
declare(strict_types=1);

namespace App\Validators;

class AuthorizationValidator
{
    public function validate(array $data): bool|array
    {
        $errors = [];
        if (empty($data['login'])) {
            $errors['login'] = 'Field "login" is required';
        }
        if (empty($data['password'])) {
            $errors['password'] = 'Field "password" is required';
        }
        if (!empty($errors)) {
            return $errors;
        }
        return true;
    }
}
