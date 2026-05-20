<?php

namespace App\Providers;

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecialityController;
use App\Http\Controllers\UserController;
use App\Services\AppointmentService;
use App\View\Composers\SidebarComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    $this->app->bind(UserController::class);
    $this->app->bind(RoleController::class);
    $this->app->bind(SpecialityController::class);
    $this->app->bind(DoctorController::class);
    $this->app->bind(PatientController::class);
    $this->app->bind(AppointmentController::class);
    $this->app->bind(DashboardController::class);
    $this->app->bind(AuthController::class);
    $this->app->bind(AppointmentService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.admin', SidebarComposer::class);
    }
}
