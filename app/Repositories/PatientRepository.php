<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Repositories\Interfaces\PatientRepositoryInterface;

class PatientRepository implements PatientRepositoryInterface
{
    public function update(Patient $patient, array $data): bool
    {
        return $patient->update($data);
    }
}
