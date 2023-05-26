<?php
declare(strict_types=1);

namespace bootstrap;

class Console
{
    public function __construct()
    {
        DB::getConnection();
    }
}
