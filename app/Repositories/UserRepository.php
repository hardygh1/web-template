<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserRepository implements UserRepositoryInterface
{
    public function create(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): bool
    {
        return $user->update($data);
    }

    public function delete(User $user): bool
    {
        return $user->delete();
    }

    public function attachRole(User $user, int $roleId): void
    {
        $user->roles()->attach($roleId);
    }

    public function syncRole(User $user, int $roleId): void
    {
        $user->roles()->sync([$roleId]);
    }

    public function detachRoles(User $user): void
    {
        $user->roles()->detach();
    }

    public function updatePassword(User $user, string $password): bool
    {
        $user->password = Hash::make($password);

        return $user->save();
    }
}
