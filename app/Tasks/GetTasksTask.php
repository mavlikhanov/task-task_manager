<?php
declare(strict_types=1);

namespace App\Tasks;

use App\Collections\TaskCollection;
use App\Repositories\TaskRepository;

class GetTasksTask
{
    public function run(int $page, array $getParameters = []): TaskCollection
    {
        $repository = new TaskRepository();
        if (empty($getParameters)) {
            $getParameters = [
                'sort' => 'id',
                'type' => 'desc'
            ];
        }
        return $repository->getTasks($page, $getParameters);
    }
}
