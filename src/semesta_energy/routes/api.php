<?php

use App\Http\Controllers\ChampionController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\PositionsController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [UsersController::class, 'login'])->name('auth.login');
    Route::post('register', [UsersController::class, 'register'])->name('auth.register');
});
Route::group(['prefix' => 'positions'], function () {
    Route::get('/', [PositionsController::class, 'index'])->name('positions.index');
    Route::get('/{id}', [PositionsController::class, 'show'])->name('positions.show');
    Route::post('/', [PositionsController::class, 'create'])->name('positions.create');
    Route::patch('/{id}', [PositionsController::class, 'editPosition'])->name('positions.edit-position');
    Route::patch('/{id}/assign-department', [PositionsController::class, 'assignDepartment'])->name('positions.assign-department');
    Route::delete('/{id}', [PositionsController::class, 'deletePosition'])->name('positions.delete-position');
});

Route::group(['prefix' => 'departments'], function () {
    Route::get('/', [DepartmentsController::class, 'index'])->name('departments.index');
    Route::get('/{id}', [DepartmentsController::class, 'show'])->name('departments.show');
    Route::post('/', [DepartmentsController::class, 'create'])->name('departments.create');
    Route::patch('/{id}', [DepartmentsController::class, 'editDepartment'])->name('departments.department-edit');
    Route::delete('/{id}', [DepartmentsController::class, 'deleteDepartment'])->name('departments.delete-department');
});
Route::group(['prefix' => 'employees'], function () {
    Route::get('/', [EmployeesController::class, 'index'])->name('employees.index');
    Route::get('/{id}', [EmployeesController::class, 'show'])->name('employees.show');
    Route::post('/', [EmployeesController::class, 'create'])->name('employees.create');
    Route::group(['middleware' => 'auth:api'], function () {

        Route::patch('/{id}', [EmployeesController::class, 'editEmployee'])->name('employees.department-edit');
    });
    Route::delete('/{id}', [EmployeesController::class, 'deleteEmployee'])->name('employees.delete-department');
});
Route::group(['prefix' => 'champions'], function () {
    Route::get('/', [ChampionController::class, 'index'])->name('champion-data');
});
