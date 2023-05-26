<?php
declare(strict_types=1);

namespace databases\Migrations;

use App\Models\AdminUser;
use App\Repositories\AdminRepository;
use system\App\AbstractMigration;

class CreateAdminUsersMigration extends AbstractMigration
{
    public string $tableName = 'admin_users';

    public function up()
    {
        $sql = "
            CREATE TABLE {$this->tableName} (
                id INT PRIMARY KEY AUTO_INCREMENT,
                login VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )
        ";
        $this->run($sql);
        $this->createDefaultAdmin();
    }

    private function createDefaultAdmin(): void
    {
        $adminUser = new AdminUser();
        $adminUser->setLogin('admin')->setPassword('123');
        $adminRepository = new AdminRepository();
        $adminRepository->create($adminUser);
    }
}
