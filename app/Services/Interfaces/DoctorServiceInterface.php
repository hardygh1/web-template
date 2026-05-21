<?php

namespace App\Services\Interfaces;

use App\Models\Doctor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface DoctorServiceInterface
{
    public function getEditData(Doctor $doctor): array;

    public function update(Request $request, Doctor $doctor): RedirectResponse;
}
