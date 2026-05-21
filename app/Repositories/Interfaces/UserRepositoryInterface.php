<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;

    public function update(User $user, array $data): bool;

    public function delete(User $user): bool;

    public function attachRole(User $user, int $roleId): void;

    public function syncRole(User $user, int $roleId): void;

    public function detachRoles(User $user): void;

    public function updatePassword(User $user, string $password): bool;
}
