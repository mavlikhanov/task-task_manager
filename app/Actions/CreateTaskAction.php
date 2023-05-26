<?php
declare(strict_types=1);

namespace App\Actions;

use App\Models\Task;
use App\Repositories\TaskRepository;
use App\Validators\TaskValidator;

class CreateTaskAction
{
        public function run(array $requestData): bool|array
    {
        $validator = new TaskValidator();
        $resultValidation = $validator->validate($requestData);
        if (is_array($resultValidation)) {
            return $resultValidation;
        }
        $task = new Task();
        $requestData['is_done'] = filter_var($requestData['is_done'], FILTER_VALIDATE_BOOLEAN);
        $task->setName($requestData['name'])
            ->setEmail($requestData['email'])
            ->setText($requestData['text'])
            ->setIsDone($requestData['is_done']);

        $repository = new TaskRepository();
        $repository->create($task);
        return true;
    }
}
