<?php

namespace App\Repositories;

use App\Models\Doctor;
use App\Repositories\Interfaces\DoctorRepositoryInterface;

class DoctorRepository implements DoctorRepositoryInterface
{
    public function update(Doctor $doctor, array $data): bool
    {
        return $doctor->update($data);
    }
}
