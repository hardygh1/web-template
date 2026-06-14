<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Gestión de Empresas
Route::resource('companies', CompanyController::class);

// Gestión de Autenticación y Permisos
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class);
    