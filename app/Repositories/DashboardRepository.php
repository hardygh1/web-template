<?php

namespace App\Repositories;

use App\Models\Appointment;
use App\Repositories\Interfaces\DashboardRepositoryInterface;
use Illuminate\Support\Collection;
use Carbon\Carbon;


class DashboardRepository implements DashboardRepositoryInterface
{
    public function appointmentsByMonth(): Collection
    {
        return Appointment::selectRaw(
                'MONTH(date) as month,
                COUNT(*) as total'
            )
            ->whereYear('date', Carbon::now()->year)
            ->groupByRaw('MONTH(date)')
            ->orderByRaw('MONTH(date)')
            ->get();
    }

    public function totalAppointments(): int
    {
        return Appointment::count();
    }

    public function todayAppointments(): int
    {
        return Appointment::whereDate('date', today())
            ->count();
    }

    public function pendingAppointments(): int
    {
        return Appointment::where('status', 'pending')
            ->count();
    }

    public function completedAppointments(): int
    {
        return Appointment::where('status', 'completed')
            ->count();
    }
}