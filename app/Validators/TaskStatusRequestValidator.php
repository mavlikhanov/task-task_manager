<?php
declare(strict_types=1);

namespace App\Validators;

class TaskStatusRequestValidator
{
    public function validate(array $data): bool|array
    {
        $errors = [];
        if (empty($data['id'])) {
            $errors['id'] = 'Field "id" is required';
        }
        if (empty($data['is_done'])) {
            $errors['is_done'] = 'Field "is_done" is required';
        }
        if (!empty($errors)) {
            return $errors;
        }
        return true;
    }
}
