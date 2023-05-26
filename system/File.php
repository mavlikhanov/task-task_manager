<?php
declare(strict_types=1);

namespace system;

class File
{
    public static function exist(string $fileName): bool
    {
        return file_exists(basePath($fileName));
    }
}
