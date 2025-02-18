<?php

use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectTypeController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/home', [HomeController::class, 'index'])->middleware('auth');

//user routes
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

//category routes

Route::get('/project-types', [ProjectTypeController::class, 'index'])->name('project_types.index');
Route::get('/project-types/create', [ProjectTypeController::class, 'create'])->name('project_types.create');
Route::post('/project-types/store', [ProjectTypeController::class, 'store'])->name('project_types.store');
Route::get('/project-types/{id}/edit', [ProjectTypeController::class, 'edit'])->name('project_types.edit');
Route::put('/project-types/{id}/update', [ProjectTypeController::class, 'update'])->name('project_types.update');
Route::delete('/project-types/{id}', [ProjectTypeController::class, 'destroy'])->name('project_types.destroy');

// sub category

Route::post('/project-types/{id}/add-subcategory', [ProjectTypeController::class, 'addSubcategory'])->name('project_types.add_subcategory');
Route::get('/subcategories/{id}/edit', [ProjectTypeController::class, 'editSubcategory'])->name('subcategories.edit');
Route::put('/subcategories/{id}/update', [ProjectTypeController::class, 'updateSubcategory'])->name('subcategories.update');
Route::delete('/subcategories/{id}', [ProjectTypeController::class, 'destroySubcategory'])->name('subcategories.destroy');