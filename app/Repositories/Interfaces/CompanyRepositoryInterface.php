<?php

namespace App\Repositories\Interfaces;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface CompanyRepositoryInterface
{
    public function all(): Collection;

    public function getById(int $id): ?Company;

    public function create(array $data): Company;

    public function update(Company $company, array $data): bool;

    public function delete(Company $company): bool;

    public function getByUser(User $user): ?Company;

    public function getBySlug(string $slug): ?Company;

    public function search(string $query): Collection;
}
