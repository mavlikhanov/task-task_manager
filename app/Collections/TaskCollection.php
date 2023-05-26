<?php
declare(strict_types=1);

namespace App\Collections;

use App\Models\Task;
use Iterator;
use system\App\Pagination;

class TaskCollection implements Iterator
{
    private int $position = 0;
    private array $items = [];

    public function __construct(
        array $tasks,
        private readonly Pagination $pagination
    ) {
        foreach ($tasks as $task) {
            $taskModel = new Task();
            $this->items[] = $taskModel->setId($task['id'])
                ->setName($task['name'])
                ->setEmail($task['email'])
                ->setText($task['text'])
                ->setIsDone((bool)$task['is_done'])
                ->setCreatedAt($task['created_at'])
                ->setUpdatedAt($task['updated_at']);
        }
    }

    public function current(): mixed
    {
        return $this->items[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->items[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * @return Pagination
     */
    public function getPagination(): Pagination
    {
        return $this->pagination;
    }
}
