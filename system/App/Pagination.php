<?php
declare(strict_types=1);

namespace system\App;

class Pagination
{
    public function __construct(
        private readonly int $currentPage,
        private readonly int $totalPages
    ) {}

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }
}
