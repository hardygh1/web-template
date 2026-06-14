<?php

namespace App\Services;

use App\Repositories\Interfaces\DashboardRepositoryInterface;
use App\Services\Interfaces\DashboardServiceInterface;

class DashboardService implements DashboardServiceInterface
{
    public function __construct(
        private readonly DashboardRepositoryInterface $dashboardRepository
    ) {
    }

    public function getDashboardData(): array
    {
        return [
            'totalUsers' => $this->dashboardRepository->totalUsers(),
            'activeUsers' => $this->dashboardRepository->activeUsers(),
            'usersRegisteredToday' => $this->dashboardRepository->usersRegisteredToday(),
        ];
    }
}