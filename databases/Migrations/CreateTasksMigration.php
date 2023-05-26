<?php
declare(strict_types=1);

namespace databases\Migrations;

use system\App\AbstractMigration;

class CreateTasksMigration extends AbstractMigration
{
    public string $tableName = 'tasks';

    public function up(): void
    {
        $sql = "
            CREATE TABLE {$this->tableName} (
                `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                `name` VARCHAR(255) NOT NULL,
                `email` VARCHAR(255) NOT NULL,
                text TEXT NOT NULL,
                `is_done` tinyint(1) DEFAULT 0,
                `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            );
        ";

        $this->run($sql);
    }
}
