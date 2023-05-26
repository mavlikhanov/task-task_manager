<?php
declare(strict_types=1);

namespace App\Models;

class Task
{
    public const PER_PAGE = 3;

    public const IN_WORK_CLASS = 'text-bg-secondary';
    public const DONE_CLASS = 'text-bg-success';

    private int $id;
    private string $name;
    private string $email;
    private string $text;
    private bool $isDone;
    private string $createdAt;
    private string $updatedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Task
     */
    public function setId(int $id): Task
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return strip_tags($this->name);
    }

    /**
     * @param string $name
     * @return Task
     */
    public function setName(string $name): Task
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return strip_tags($this->email);
    }

    /**
     * @param string $email
     * @return Task
     */
    public function setEmail(string $email): Task
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return strip_tags($this->text);
    }

    /**
     * @param string $text
     * @return Task
     */
    public function setText(string $text): Task
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDone(): bool
    {
        return $this->isDone;
    }

    /**
     * @param bool $isDone
     * @return Task
     */
    public function setIsDone(bool $isDone): Task
    {
        $this->isDone = $isDone;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     * @return Task
     */
    public function setCreatedAt(string $createdAt): Task
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     * @return Task
     */
    public function setUpdatedAt(string $updatedAt): Task
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
