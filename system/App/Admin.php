<?php
declare(strict_types=1);

namespace system\App;

use App\Models\AdminUser;

class Admin
{
    public function __construct(
        private readonly AdminUser $adminUser
    ) {}

    /**
     * @return AdminUser
     */
    public function getAdminUser(): AdminUser
    {
        return $this->adminUser;
    }
}
