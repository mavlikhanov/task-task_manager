<?php
declare(strict_types=1);

namespace App\Models;

class AdminUser
{
    private int $id;
    private string $login;
    private string $password;
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
     * @return AdminUser
     */
    public function setId(int $id): AdminUser
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return string
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @param string $login
     * @return AdminUser
     */
    public function setLogin(string $login): AdminUser
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return AdminUser
     */
    public function setPassword(string $password): AdminUser
    {
        $this->password = md5($password);
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
     * @return AdminUser
     */
    public function setCreatedAt(string $createdAt): AdminUser
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
     * @return AdminUser
     */
    public function setUpdatedAt(string $updatedAt): AdminUser
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
