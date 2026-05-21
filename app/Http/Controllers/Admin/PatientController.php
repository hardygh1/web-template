<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Services\Interfaces\PatientServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PatientController extends Controller
{
    public function __construct(private readonly PatientServiceInterface $patients)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('read_paciente');
        return view('admin.patients.index');
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        Gate::authorize('update_paciente');
        return view('admin.patients.edit', $this->patients->getEditData($patient));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        Gate::authorize('update_paciente');
        return $this->patients->update($request, $patient);
    }
}
