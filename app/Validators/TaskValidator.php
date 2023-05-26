<?php
declare(strict_types=1);

namespace App\Validators;

class TaskValidator
{
    public function validate(array $data): bool|array
    {
        $errors = [];
        if (empty($data['name'])) {
            $errors['name'] = 'Field "name" is required';
        }
        if (empty($data['email'])) {
            $errors['email'] = 'Field "email" is required';
        }
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Field "email" is incorrect';
        }
        if (empty($data['text'])) {
            $errors['text'] = 'Field "text" is required';
        }
        if (!empty($errors)) {
            return $errors;
        }
        return true;
    }
}
