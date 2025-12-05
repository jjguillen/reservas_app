<?php

use App\Http\Controllers\ReservaController;
use App\Http\Resources\MesaResource;
use App\Models\Mesa;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//TODAS LAS URLS VAN CON /api delante

//RUTA PARA GENERAR TOKENS (no protegida) ------------------------------------------------------------------------
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    //Comprobar credenciales
    if (!Auth::attempt($credentials)) {
        abort(401);
    }

    //Generar token
    $token = Auth::user()->createToken('my-app-token')->plainTextToken;
    return response()->json(['token' => $token, 'user' => Auth::user()]);
});


//RUTAS PROTEGIDAS ------------------------------------------------------------------------------------------------
Route::middleware(['auth:sanctum'])->group(function () {
    //Muestras todas las mesas del restaurante
    Route::get('/mesas', [ReservaController::class, 'apiGetMesas']);

    //Muestra una sola mesa por id
    Route::get('/mesas/{id}', [ReservaController::class, 'apiGetMesaById']);

    //Si eres admin puedes ver todas las reservas
    Route::get('/reservas/admin', [ReservaController::class, 'apiGetReservasAdmin']);

    //Muestra tus reservas (token)
    Route::get('/reservas', [ReservaController::class, 'apiGetReservas']);

    //Muestra una sola reserva por id, si es tuya te deja verla, sino te bloquea
    Route::get('/reservas/{id}', [ReservaController::class, 'apiGetReservasById']);

    //Crea una nueva reserva validando disponibilidad y tamaño de mesa
    Route::post('/reservas', [ReservaController::class, 'apiNewReserva']);

    //Modifica una reserva cancelandola sólo si es tuya o si eres admin
    Route::put('/reservas/{id}', [ReservaController::class, 'apiUpdateReserva']);

    //Elimina una reserva sólo si es tuya o si eres admin
    Route::delete('/reservas/{id}', [ReservaController::class, 'apiDeleteReserva']);
});
