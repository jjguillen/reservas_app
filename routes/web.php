<?php

use App\Http\Controllers\ReservaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', function () {
    $url = Storage::disk('s3')->url('reservas.jpg');
    return view('welcome', compact('url'));
});


//RUTAS PROTEGIDAS LOGIN
Route::middleware(['auth'])->group(function () {
    //Una vez logueado o registrado
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    //Mostrar reservas propias
    Route::get('/mis-reservas', [ReservaController::class, 'index'])->name('mis_reservas');

    //Mostrar formulario para crear una nueva reserva
    Route::get('/nueva-reserva', [ReservaController::class, 'new'])->name('reservas.nueva');

    //Buscar disponibilidad para una nueva reserva
    Route::post('/buscar-disponibilidad', [ReservaController::class, 'buscarDisponibilidad'])->name('reservas.buscar');

    //Almacenar una nueva reserva
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');

    //Cancelar una reserva
    Route::get('/reservas/{reserva}/cancelar', [ReservaController::class, 'cancelar'])->name('reservas.cancelar');

});

//RUTAS PROTEGIDAS POR LOGIN Y ADMIN
Route::middleware(['auth','admin'])->group(function () {
    //Revisar reservas pendientes
    Route::get('/reservas/pendientes', [ReservaController::class, 'pendientes'])->name('reservas.pendientes');

    //Filtrar reservas
    Route::post('/reservas/filtrar', [ReservaController::class, 'filtrar'])->name('reservas.filtrar');

    //Confirmar una reserva
    Route::get('/reservas/{reserva}/confirmar', [ReservaController::class, 'confirmar'])->name('reservas.confirmar');

});
