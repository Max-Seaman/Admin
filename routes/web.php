<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

Route::resource('companies', CompanyController::class);
Route::resource('employees', EmployeeController::class);