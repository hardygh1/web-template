<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Services\Interfaces\DoctorServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DoctorController extends Controller
{
    public function __construct(private readonly DoctorServiceInterface $doctors)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('read_doctor');
        return view('admin.doctors.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        Gate::authorize('update_doctor');
        return view('admin.doctors.edit', $this->doctors->getEditData($doctor));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        Gate::authorize('update_doctor');
        return $this->doctors->update($request, $doctor);
    }

    public function schedules(Doctor $doctor)
    {
        Gate::authorize('update_doctor');

        return view('admin.doctors.schedules', compact('doctor'));
    }
}
