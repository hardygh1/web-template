<?php

namespace App\Services;

use App\Repositories\Interfaces\AppointmentRepositoryInterface;
use App\Services\Interfaces\AppointmentServiceInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;

class AppointmentService implements AppointmentServiceInterface
{
    public function __construct(private readonly AppointmentRepositoryInterface $appointments)
    {
    }

    public function searchAvailability($date, $hour, $speciality_id): Collection
    {
        $date = Carbon::parse($date);
        $hourStart = Carbon::parse($hour)->format('H:i:s');
        $hourEnd = Carbon::parse($hour)->addHour()->format('H:i:s');

        $doctors = $this->appointments->searchAvailableDoctors(
            $date->toDateString(),
            $hourStart,
            $hourEnd,
            $speciality_id ? (int) $speciality_id : null
        );

        return $this->processResults($doctors);

    }

    public function processResults($doctors)
    {
        return $doctors->mapWithKeys(function($doctor){

            $schedules = $this->getAvailableSchedules($doctor->schedules, $doctor->appointments);

            /* return [
                $doctor->id => [
                    'doctor' => $doctor,
                    'schedules' => $schedules,
                ]
            ]; */

            return $schedules->contains('disabled', false) ? 
                [ $doctor->id => [
                    'doctor' => $doctor,
                    'schedules' => $schedules,
                ]
            ] : [];
        });
    }

    public function getAvailableSchedules($schedules, $appointments)
    {
        return $schedules->map(function($schedule) use ($appointments) {

            $isBooked = $appointments->some(function($appointment) use($schedule){
                $appointmentPeriod = CarbonPeriod::create(
                    $appointment->start_time,
                    config('schedule.appointment_duration') . ' minutes',
                    $appointment->end_time
                )->excludeEndDate();

                return $appointmentPeriod->contains($schedule->start_time);
            });

            return [
                'start_time' => $schedule->start_time->format('H:i:s'),
                'disabled' => $isBooked,
            ];
        });
    }
}
