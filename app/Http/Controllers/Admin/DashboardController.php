<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\DashboardServiceInterface;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller
{
    public function index(
        DashboardServiceInterface $dashboardService
    )
    {
        Gate::authorize('access_dashboard');

        $dashboardData = $dashboardService->getDashboardData();

        return view(
            'admin.dashboard',
            $dashboardData
        );
    }
}