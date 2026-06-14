<?php

namespace App\Repositories;

use App\Models\Company;
use App\Models\User;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function all(): Collection
    {
        return Company::active()->get();
    }

    public function getById(int $id): ?Company
    {
        return Company::find($id);
    }

    public function create(array $data): Company
    {
        return Company::create($data);
    }

    public function update(Company $company, array $data): bool
    {
        return $company->update($data);
    }

    public function delete(Company $company): bool
    {
        return $company->delete();
    }

    public function getByUser(User $user): ?Company
    {
        return $user->company;
    }

    public function getBySlug(string $slug): ?Company
    {
        return Company::where('slug', $slug)->first();
    }

    public function search(string $query): Collection
    {
        return Company::where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%")
            ->orWhere('legal_name', 'like', "%{$query}%")
            ->get();
    }
}
