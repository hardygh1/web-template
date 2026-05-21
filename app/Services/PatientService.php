<?php

namespace App\Services;

use App\Models\Patient;
use App\Repositories\Interfaces\BloodTypeRepositoryInterface;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Services\Interfaces\PatientServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PatientService implements PatientServiceInterface
{
    public function __construct(
        private readonly PatientRepositoryInterface $patients,
        private readonly BloodTypeRepositoryInterface $bloodTypes
    ) {
    }

    public function getEditData(Patient $patient): array
    {
        return [
            'patient' => $patient,
            'bloodTypes' => $this->bloodTypes->all(),
        ];
    }

    public function update(Request $request, Patient $patient): RedirectResponse
    {
        $data = $request->validate([
            'blood_type_id' => 'nullable|exists:blood_types,id',
            'allergies' => 'nullable|string|max:255',
            'chronic_conditions' => 'nullable|string|max:255',
            'surgical_history' => 'nullable|string|max:255',
            'family_history' => 'nullable|string|max:255',
            'observations' => 'nullable|string|max:255',
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relationship' => 'nullable|string|max:50',
        ]);

        $this->patients->update($patient, $data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Paciente actualizado',
            'text' => 'Los datos del paciente han sido actualizados correctamente.',
        ]);

        return redirect()->route('admin.patients.edit', $patient);
    }
}
