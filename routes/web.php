<?php

use App\Http\Controllers\EmployeeConteoller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employees', [EmployeeConteoller::class, 'index'])->name('employee.index');
Route::get('/employees/create', [EmployeeConteoller::class, 'create'])->name('employees.create');
Route::post('/employees', [EmployeeConteoller::class, 'store'])->name('employees.store');
Route::get('/employees/{employee}/edit', [EmployeeConteoller::class, 'edit'])->name('employees.edit');
Route::put('/employees/{employee}', [EmployeeConteoller::class, 'update'])->name('employees.update');
Route::delete('/employees/{employee}', [EmployeeConteoller::class, 'destroy'])->name('employees.destroy');
