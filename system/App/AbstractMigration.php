<?php
declare(strict_types=1);

namespace system\App;

use bootstrap\DB;
use PDO;

abstract class AbstractMigration
{
    public string $tableName;

    abstract protected function up();

    public function run(string $sql): void
    {
        $statement = $this->connection()->prepare($sql);
        $statement->execute();
    }

    private function connection(): PDO
    {
        return DB::getConnection();
    }
}
