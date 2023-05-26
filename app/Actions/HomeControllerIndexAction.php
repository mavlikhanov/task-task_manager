<?php
declare(strict_types=1);

namespace App\Actions;

use App\Collections\TaskCollection;
use App\Tasks\GetTasksTask;

class HomeControllerIndexAction
{
    public function run(int $page, array $getParameters = []): TaskCollection
    {
        $getTasksTask = new GetTasksTask();
        return $getTasksTask->run($page, $getParameters);
    }
}
