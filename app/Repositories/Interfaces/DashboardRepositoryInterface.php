<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface DashboardRepositoryInterface
{
    public function appointmentsByMonth(): Collection;

    public function totalAppointments(): int;

    public function todayAppointments(): int;

    public function pendingAppointments(): int;

    public function completedAppointments(): int;
}