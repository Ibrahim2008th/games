<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\UserRoleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/geheim', function () {
    return view('geheim');
})->middleware('auth');


// Iedereen mag de games bekijken
Route::get('/games', [GameController::class, 'index']);

// Alleen voor ingelogde gebruikers
Route::middleware('auth')->group(function () {
    Route::get('/games/create', [GameController::class, 'create']);
    Route::post('/games/store', [GameController::class, 'store']);

    Route::get('/games/edit/{id}', [GameController::class, 'edit']);
    Route::post('/games/update/{id}', [GameController::class, 'update']);

    Route::post('/games/destroy/{id}', [GameController::class, 'destroy']);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.index');

    Route::get('/permissions', [PermissionController::class, 'index'])
        ->name('admin.permissions.index');

    Route::get('/permissions/create', [PermissionController::class, 'create'])
        ->name('admin.permissions.create');

    Route::post('/permissions', [PermissionController::class, 'store'])
        ->name('admin.permissions.store');

});
Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])
    ->name('admin.permissions.edit');
    Route::put('/permissions/{permission}', [PermissionController::class, 'update'])
    ->name('admin.permissions.update');
    Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])
    ->name('admin.permissions.destroy');
    Route::get('/roles', [RoleController::class, 'index'])
    ->name('admin.roles.index');

Route::get('/roles/create', [RoleController::class, 'create'])
    ->name('admin.roles.create');

Route::post('/roles', [RoleController::class, 'store'])
    ->name('admin.roles.store');
    Route::get('/roles', [RoleController::class, 'index'])
    ->name('admin.roles.index');

Route::get('/roles/create', [RoleController::class, 'create'])
    ->name('admin.roles.create');

Route::post('/roles', [RoleController::class, 'store'])
    ->name('admin.roles.store');

Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])
    ->name('admin.roles.edit');

Route::put('/roles/{role}', [RoleController::class, 'update'])
    ->name('admin.roles.update');
    Route::get('/role-permissions', [RolePermissionController::class, 'index'])
    ->name('admin.role-permissions.index');

Route::get('/role-permissions/create', [RolePermissionController::class, 'create'])
    ->name('admin.role-permissions.create');

Route::post('/role-permissions', [RolePermissionController::class, 'store'])
    ->name('admin.role-permissions.store');

Route::delete('/role-permissions/{role}/{permission}', [RolePermissionController::class, 'destroy'])
    ->name('admin.role-permissions.destroy');
    Route::get('/user-roles', [UserRoleController::class, 'index'])
    ->name('admin.user-roles.index');

Route::get('/user-roles/create', [UserRoleController::class, 'create'])
    ->name('admin.user-roles.create');

Route::post('/user-roles', [UserRoleController::class, 'store'])
    ->name('admin.user-roles.store');

Route::get('/user-roles/{user}/edit', [UserRoleController::class, 'edit'])
    ->name('admin.user-roles.edit');

Route::put('/user-roles/{user}', [UserRoleController::class, 'update'])
    ->name('admin.user-roles.update');

Route::delete('/user-roles/{user}/{role}', [UserRoleController::class, 'destroy'])
    ->name('admin.user-roles.destroy');

Route::delete('/roles/{role}', [RoleController::class, 'destroy'])
    ->name('admin.roles.destroy');
    Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->group(function () {
        // Je admin-routes staan hier
    });
