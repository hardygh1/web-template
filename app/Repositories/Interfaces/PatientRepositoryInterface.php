<?php

namespace App\Repositories\Interfaces;

use App\Models\Patient;

interface PatientRepositoryInterface
{
    public function update(Patient $patient, array $data): bool;
}
