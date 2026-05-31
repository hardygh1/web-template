<?php

namespace App\Providers;

use App\Repositories\AppointmentRepository;
use App\Repositories\BloodTypeRepository;
use App\Repositories\Interfaces\AppointmentRepositoryInterface;
use App\Repositories\Interfaces\BloodTypeRepositoryInterface;
use App\Repositories\Interfaces\DoctorRepositoryInterface;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\SpecialityRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\DoctorRepository;
use App\Repositories\PatientRepository;
use App\Repositories\RoleRepository;
use App\Repositories\SpecialityRepository;
use App\Repositories\UserRepository;
use App\Services\AppointmentService;
use App\Services\Interfaces\AppointmentServiceInterface;
use App\Services\Interfaces\DoctorServiceInterface;
use App\Services\Interfaces\PatientServiceInterface;
use App\Services\Interfaces\RoleServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\DoctorService;
use App\Services\PatientService;
use App\Services\RoleService;
use App\Services\UserService;
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
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(PatientRepositoryInterface::class, PatientRepository::class);
        $this->app->bind(SpecialityRepositoryInterface::class, SpecialityRepository::class);
        $this->app->bind(BloodTypeRepositoryInterface::class, BloodTypeRepository::class);
        $this->app->bind(AppointmentRepositoryInterface::class, AppointmentRepository::class);
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);

        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(RoleServiceInterface::class, RoleService::class);
        $this->app->bind(DoctorServiceInterface::class, DoctorService::class);
        $this->app->bind(PatientServiceInterface::class, PatientService::class);
        $this->app->bind(AppointmentServiceInterface::class, AppointmentService::class);
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
