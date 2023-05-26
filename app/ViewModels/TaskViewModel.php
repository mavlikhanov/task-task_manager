<?php
declare(strict_types=1);

namespace App\ViewModels;

use App\Models\Task;

class TaskViewModel
{
    public function getBackgroundTask(Task $task): string
    {
        if ($task->isDone()) {
            return Task::DONE_CLASS;
        }
        return Task::IN_WORK_CLASS;
    }

    public function getActivePaginateTab($currentPage, $pageNumber): string
    {
        if ($currentPage == $pageNumber) {
            return 'active';
        }
        return '';
    }

    public function getPaginationUrl(int $currentPage, array $getParameters): string
    {
        $url = "/?page=$currentPage";
        if (!isset($getParameters['sort'])) {
            return $url;
        }
        $url .= "&sort={$getParameters['sort']}";
        $url .= "&type=" . $getParameters['type'] ?? 'desc';
        return $url;
    }
}
