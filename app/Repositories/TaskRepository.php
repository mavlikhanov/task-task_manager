<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Collections\TaskCollection;
use App\Models\Task;
use bootstrap\DB;
use PDO;
use system\Api\HttpInterface;
use system\App\Pagination;
use system\Exceptions\NotFoundRecordException;

class TaskRepository
{
    public function create(Task $task): void
    {
        $connection = DB::getConnection();
        $sql = "
            INSERT INTO tasks (`name`, `email`, `text`, `is_done`)
            VALUES (:name, :email, :text, :is_done)
        ";
        $name = htmlspecialchars($task->getName());
        $email = htmlspecialchars($task->getEmail());
        $text = htmlspecialchars($task->getText());
        $isDone = (int)$task->isDone();

        $statement = $connection->prepare($sql);
        $statement->bindParam(':name', $name);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':text', $text);
        $statement->bindParam(':is_done', $isDone);
        $statement->execute();
    }

    public function getById(int $id): Task
    {
        $connection = DB::getConnection();
        $sql = "SELECT * FROM tasks WHERE id = :id LIMIT 1";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $task = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$task) {
            throw new NotFoundRecordException("Task with id: $id not found", HttpInterface::NOT_FOUND);
        }
        $taskModel = new Task();
        return $taskModel->setId((int)$task['id'])
            ->setEmail($task['email'])
            ->setText($task['email'])
            ->setName($task['name'])
            ->setIsDone((bool)$task['is_done'])
            ->setCreatedAt($task['created_at'])
            ->setUpdatedAt($task['updated_at']);
    }

    public function update(Task $task): void
    {
        $connection = DB::getConnection();
        $sql = "UPDATE tasks SET name = :name, email = :email, text = :text, is_done = :is_done WHERE id = :id";

        $id = $task->getId();
        $name = $task->getName();
        $email = $task->getEmail();
        $text = $task->getText();
        $isDone = $task->isDone();

        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->bindValue(':text', $text, PDO::PARAM_STR);
        $statement->bindValue(':is_done', $isDone, PDO::PARAM_INT);
        $statement->execute();
    }

    public function getTasks(int $page = 1, array $getParameters = []): TaskCollection
    {
        $connection = DB::getConnection();
        $countRows = $this->getCountRows();
        $totalPages = (int)ceil($countRows / Task::PER_PAGE);
        $offset = ($page - 1) * Task::PER_PAGE;

        $sortField = htmlspecialchars($getParameters['sort']);
        $sortType = htmlspecialchars($getParameters['type']);

        $sql = "SELECT * FROM tasks ORDER BY $sortField $sortType LIMIT :offset, :perPage";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':offset', $offset, PDO::PARAM_INT);
        $statement->bindValue(':perPage', Task::PER_PAGE, PDO::PARAM_INT);
        $statement->execute();
        $items = $statement->fetchAll(PDO::FETCH_ASSOC);
        $pagination = new Pagination($page, $totalPages);
        return new TaskCollection($items, $pagination);
    }

    private function getCountRows(): int
    {
        $connection = DB::getConnection();
        $sqlCount = "SELECT COUNT(*) AS total FROM tasks";
        $statement = $connection->query($sqlCount);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return (int)$result['total'];
    }
}
