<?php
declare(strict_types=1);

namespace App\Actions;

use App\Repositories\TaskRepository;
use App\Validators\TaskStatusRequestValidator;

class TaskStatusUpdateAction
{
    public function run(array $requestData): array|bool
    {
        if (!isAuthorized()) {
            return [
                'is_authorized' => 'You must be authorized'
            ];
        }
        $validator = new TaskStatusRequestValidator();
        $resultValidation = $validator->validate($requestData);
        if (is_array($resultValidation)) {
            return $resultValidation;
        }
        $repository = new TaskRepository();
        $task = $repository->getById((int)$requestData['id']);
        $requestData['is_done'] = filter_var($requestData['is_done'], FILTER_VALIDATE_BOOLEAN);
        if ($task->isDone() == $requestData['is_done']) {
            return [
                'is_done' => "'Incorrect 'is_done' field'"
            ];
        }
        $task->setIsDone((bool)$requestData['is_done']);
        $repository->update($task);
        return true;
    }
}
