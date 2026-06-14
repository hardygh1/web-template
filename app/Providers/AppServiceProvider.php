<?php

namespace App\Providers;

use App\Repositories\RoleRepository;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\RoleService;
use App\Services\Interfaces\RoleServiceInterface;
use App\Services\UserService;
use App\Services\Interfaces\UserServiceInterface;
use App\View\Composers\SidebarComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Services\DashboardService;
use App\Services\Interfaces\DashboardServiceInterface;
use App\Repositories\DashboardRepository;
use App\Repositories\Interfaces\DashboardRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RoleRepositoryInterface::class, RoleRepository::class);
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);

        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(RoleServiceInterface::class, RoleService::class);
        $this->app->bind(DashboardServiceInterface::class, DashboardService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.admin', SidebarComposer::class);
    }
}
