<?php
declare(strict_types=1);

namespace App\Actions;

use App\Repositories\TaskRepository;
use App\Validators\TaskValidator;
use system\Exceptions\NotFoundRecordException;

class UpdateTaskAction
{
    public function run(array $requestData): bool|array
    {
        if (!isAuthorized()) {
            return [
                'is_authorized' => 'You must be authorized'
            ];
        }
        $validator = new TaskValidator();
        $resultValidation = $validator->validate($requestData);
        if (is_array($resultValidation)) {
            return $resultValidation;
        }
        $repository = new TaskRepository();
        $task = null;
        try {
            $task = $repository->getById((int)$requestData['id']);
        } catch (NotFoundRecordException $exception) {
            return [
                'id' => $exception->getMessage()
            ];
        }
        $task->setName($requestData['name'])
            ->setEmail($requestData['email'])
            ->setText($requestData['text']);
        $repository->update($task);
        return true;
    }
}
