<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\DashboardRepositoryInterface;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function totalUsers(): int
    {
        return User::count();
    }

    public function activeUsers(): int
    {
        return User::where('email_verified_at', '!=', null)->count();
    }

    public function usersRegisteredToday(): int
    {
        return User::whereDate('created_at', today())->count();
    }
}