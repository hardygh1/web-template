<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface AppointmentRepositoryInterface
{
    public function searchAvailableDoctors(string $date, string $hourStart, string $hourEnd, ?int $specialityId = null): Collection;
}
