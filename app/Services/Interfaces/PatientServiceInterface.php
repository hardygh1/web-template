<?php

namespace App\Services\Interfaces;

use App\Models\Patient;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface PatientServiceInterface
{
    public function getEditData(Patient $patient): array;

    public function update(Request $request, Patient $patient): RedirectResponse;
}
