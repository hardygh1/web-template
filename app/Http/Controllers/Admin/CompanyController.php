<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Services\Interfaces\CompanyServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CompanyController extends Controller
{
    use AuthorizesRequests;

    public function __construct(
        private readonly CompanyServiceInterface $service
    ) {
    }

    public function index(): View
    {
        $this->authorize('viewAny', Company::class);

        return view('admin.companies.index');
    }

    public function create(): View
    {
        $this->authorize('create', Company::class);
        $data = $this->service->getCreateData();

        return view('admin.companies.create', $data);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Company::class);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:companies,name',
            'legal_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'phone' => 'nullable|string|max:20',
            'description' => 'nullable|string|max:1000',
        ]);

        $company = $this->service->create($validated);

        return redirect()->route('admin.companies.show', $company)
            ->with('success', 'Empresa creada exitosamente.');
    }

    public function show(Company $company): View
    {
        $this->authorize('view', $company);

        return view('admin.companies.show', compact('company'));
    }

    public function edit(Company $company): View
    {
        $this->authorize('update', $company);
        $data = $this->service->getEditData($company);

        return view('admin.companies.edit', $data);
    }

    public function update(Request $request, Company $company)
    {
        $this->authorize('update', $company);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:companies,name,' . $company->id,
            'legal_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:companies,email,' . $company->id,
            'phone' => 'nullable|string|max:20',
            'description' => 'nullable|string|max:1000',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $this->service->update($company->id, $validated);

        return redirect()->route('admin.companies.show', $company)
            ->with('success', 'Empresa actualizada exitosamente.');
    }

    public function destroy(Company $company)
    {
        $this->authorize('delete', $company);

        $this->service->delete($company->id);

        return redirect()->route('admin.companies.index')
            ->with('success', 'Empresa eliminada exitosamente.');
    }
}
