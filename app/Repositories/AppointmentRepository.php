<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Repositories\Interfaces\AppointmentRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class AppointmentRepository implements AppointmentRepositoryInterface
{
    public function searchAvailableDoctors(string $date, string $hourStart, string $hourEnd, ?int $specialityId = null): Collection
    {
        $appointmentDate = Carbon::parse($date);

        return Doctor::whereHas('schedules', function ($query) use ($appointmentDate, $hourStart, $hourEnd) {
                $query->where('day_of_week', $appointmentDate->dayOfWeek)
                    ->where('start_time', '>=', $hourStart)
                    ->where('start_time', '<', $hourEnd);
            })
            ->when($specialityId, function ($query, $specialityId) {
                return $query->where('speciality_id', $specialityId);
            })
            ->with([
                'user',
                'speciality',
                'schedules' => function ($query) use ($appointmentDate, $hourStart, $hourEnd) {
                    $query->where('day_of_week', $appointmentDate->dayOfWeek)
                        ->where('start_time', '>=', $hourStart)
                        ->where('start_time', '<', $hourEnd);
                },
                'appointments' => function ($query) use ($appointmentDate, $hourStart, $hourEnd) {
                    $query->whereDate('date', $appointmentDate)
                        ->where('start_time', '>=', $hourStart)
                        ->where('start_time', '<', $hourEnd);
                },
            ])
            ->get();
    }
}
