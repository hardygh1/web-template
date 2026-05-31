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
            'appointmentsByMonth' => $this->dashboardRepository->appointmentsByMonth(),
            'totalAppointments' => $this->dashboardRepository->totalAppointments(),
            'todayAppointments' => $this->dashboardRepository->todayAppointments(),
            'pendingAppointments' => $this->dashboardRepository->pendingAppointments(),
            'completedAppointments' => $this->dashboardRepository->completedAppointments(),
        ];
    }
}