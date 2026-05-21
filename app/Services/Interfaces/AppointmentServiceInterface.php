<?php

namespace App\Services\Interfaces;

use Illuminate\Support\Collection;

interface AppointmentServiceInterface
{
    public function searchAvailability($date, $hour, $speciality_id): Collection;
}
