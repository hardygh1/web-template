<?php

namespace App\Services;

use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterface;
use App\Services\Interfaces\CompanyServiceInterface;

class CompanyService implements CompanyServiceInterface
{
    public function __construct(
        private readonly CompanyRepositoryInterface $repository
    ) {
    }

    public function getAll()
    {
        return $this->repository->all();
    }

    public function getById(int $id): ?Company
    {
        return $this->repository->getById($id);
    }

    public function create(array $data): Company
    {
        $data['created_by'] = auth()->id();
        $data['slug'] = $this->generateSlug($data['name']);

        return $this->repository->create($data);
    }

    public function update(int $id, array $data): bool
    {
        $company = $this->repository->getById($id);

        if (! $company) {
            return false;
        }

        if (isset($data['name']) && $data['name'] !== $company->name) {
            $data['slug'] = $this->generateSlug($data['name']);
        }

        return $this->repository->update($company, $data);
    }

    public function delete(int $id): bool
    {
        $company = $this->repository->getById($id);

        if (! $company) {
            return false;
        }

        return $this->repository->delete($company);
    }

    public function search(string $query)
    {
        return $this->repository->search($query);
    }

    public function getCreateData(): array
    {
        return [];
    }

    public function getEditData(Company $company): array
    {
        return [
            'company' => $company,
        ];
    }

    private function generateSlug(string $name): string
    {
        $slug = strtolower($name);
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
        $slug = trim($slug, '-');

        $base = $slug;
        $counter = 1;

        while (Company::where('slug', $slug)->exists()) {
            $slug = "{$base}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
