<?php

namespace App\Services;

use App\Models\Doctor;
use App\Repositories\Interfaces\DoctorRepositoryInterface;
use App\Repositories\Interfaces\SpecialityRepositoryInterface;
use App\Services\Interfaces\DoctorServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DoctorService implements DoctorServiceInterface
{
    public function __construct(
        private readonly DoctorRepositoryInterface $doctors,
        private readonly SpecialityRepositoryInterface $specialities
    ) {
    }

    public function getEditData(Doctor $doctor): array
    {
        return [
            'doctor' => $doctor,
            'specialities' => $this->specialities->all(),
        ];
    }

    public function update(Request $request, Doctor $doctor): RedirectResponse
    {
        $data = $request->validate([
            'speciality_id' => 'nullable|exists:specialities,id',
            'medical_license_number' => 'nullable|string|max:255|unique:doctors,medical_license_number,' . $doctor->id,
            'biography' => 'nullable|string',
            'active' => 'boolean',
        ]);

        $this->doctors->update($doctor, $data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Doctor actualizado',
            'text' => 'Los datos del doctor se han actualizado correctamente.',
        ]);

        return redirect()->route('admin.doctors.edit', $doctor);
    }
}
