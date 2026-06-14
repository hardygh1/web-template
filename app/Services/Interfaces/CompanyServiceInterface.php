<?php

namespace App\Services\Interfaces;

use App\Models\Company;

interface CompanyServiceInterface
{
    public function getAll();

    public function getById(int $id): ?Company;

    public function create(array $data): Company;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function search(string $query);

    public function getCreateData(): array;

    public function getEditData(Company $company): array;
}
