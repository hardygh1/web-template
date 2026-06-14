<?php

namespace App\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface DashboardRepositoryInterface
{
    public function totalUsers(): int;

    public function activeUsers(): int;

    public function usersRegisteredToday(): int;
}