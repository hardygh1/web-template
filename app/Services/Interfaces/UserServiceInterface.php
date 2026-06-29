<?php

namespace App\Services\Interfaces;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

interface UserServiceInterface
{
    public function getCreateData(): array;

    public function getEditData(User $user): array;

    public function store(Request $request): RedirectResponse;

    public function update(Request $request, User $user): RedirectResponse;

    public function destroy(User $user): RedirectResponse;

    public function guardCompany(User $user): ?RedirectResponse;
}
