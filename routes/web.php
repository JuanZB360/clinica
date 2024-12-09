<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AppointmentController;

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

Route::middleware('auth')->group(function () {

    Route::get('/usuarios',[UserController::class, 'index'])->name('user.index');
    Route::get('/usuarios/crear',[UserController::class, 'create'])->name('user.create');
    Route::post('/usuarios/guardar',[UserController::class,'store'])->name('user.store');
    Route::get('/usuario/{user}/detalles', [UserController::class,'show'])->name('user.show');
    Route::get('/usuarios/{user}/editar', [UserController::class,'edit'])->name('user.edit');
    Route::put('/usuarios/{user}/actualizar', [UserController::class,'update'])->name('user.update');
    Route::delete('/usuarios/{user}/eliminar', [UserController::class,'destroy'])->name('user.destroy');

    Route::get('/citas', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::get('/citas/crear', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/citas/guardar', [AppointmentController::class,'store'])->name('appointment.store');
    Route::get('/cita/{appointment}/editar', [AppointmentController::class,'edit'])->name('appointment.edit');
    Route::put('/cita/{appointment}/actualizar', [AppointmentController::class,'update'])->name('appointment.update');
    Route::delete('/cita/{appointment}/eliminar', [AppointmentController::class,'destroy'])->name('appointment.destroy');

});