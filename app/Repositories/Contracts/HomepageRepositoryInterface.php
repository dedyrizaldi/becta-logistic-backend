<?php

namespace App\Repositories\Contracts;

interface HomepageRepositoryInterface
{
    /**
     * Get homepage data.
     */
    public function getHomepageData(): array;
}