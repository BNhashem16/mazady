<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('employees', [EmployeeController::class, 'show'])->name('employees.show');
Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
