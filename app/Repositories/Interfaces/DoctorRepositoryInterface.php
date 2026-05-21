<?php

namespace App\Repositories\Interfaces;

use App\Models\Doctor;

interface DoctorRepositoryInterface
{
    public function update(Doctor $doctor, array $data): bool;
}
