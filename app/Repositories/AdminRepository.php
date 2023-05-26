<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\AdminUser;
use bootstrap\DB;
use PDO;

class AdminRepository
{
    public function create(AdminUser $adminUser): void
    {
        $connection = DB::getConnection();
        $sql = "
            INSERT INTO admin_users (`login`, `password`)
            VALUES (:login, :password)
        ";
        $login = $adminUser->getLogin();
        $password = $adminUser->getPassword();

        $statement = $connection->prepare($sql);
        $statement->bindParam(':login', $login);
        $statement->bindParam(':password', $password);
        $statement->execute();
    }

    public function getByLoginAndPassword(string $login, string $password): ?AdminUser
    {
        $connection = DB::getConnection();
        $statement = $connection->prepare('SELECT * FROM admin_users WHERE login = ? and password = ?');
        $statement->execute([$login, $password]);
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        if (empty($user)) {
            return null;
        }
        $adminUser = new AdminUser();
        $adminUser->setLogin($user['login'])
            ->setId((int) $user['id']);
        return $adminUser;
    }
}
