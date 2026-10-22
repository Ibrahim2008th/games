<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PermissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';



Route::get('/games', [GameController::class, 'index'])
    ->middleware(['auth', 'role:klant|admin'])
    ->name('games.index');



Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/games/create', [GameController::class, 'create'])
        ->name('games.create');

    Route::post('/games/store', [GameController::class, 'store'])
        ->name('games.store');

    Route::get('/games/edit/{id}', [GameController::class, 'edit'])
        ->name('games.edit');

    Route::post('/games/update/{id}', [GameController::class, 'update'])
        ->name('games.update');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/permissions', [PermissionController::class, 'index'])
        ->name('admin.permissions.index');
    Route::get('/admin/permissions/create', [PermissionController::class, 'create'])
    ->name('admin.permissions.create');

});
});