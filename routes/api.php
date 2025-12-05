<?php

use App\Http\Controllers\ReservaController;
use App\Http\Resources\MesaResource;
use App\Models\Mesa;
use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//TODAS LAS URLs VAN CON /api delante

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//RUTA PARA GENERAR TOKENS
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    //Comprobar credenciales
    if (!Auth::attempt($credentials)) {
        abort(401);
    }

    $token = Auth::user()->createToken('my-app-token')->plainTextToken;

    return response()->json(['token' => $token, 'user' => Auth::user()]);
});

//RUTAS PROTEGIDAS
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/mesas', function () {
        return MesaResource::collection(Mesa::all());
    });

    Route::get('/mesas/{id}', function (string $id) {
        return Mesa::findOrFail($id)->toResource();
    });

    Route::get('/reservas', function () {
        return Reserva::all()->toResourceCollection();
    });

    Route::get('/reservas/{id}', function (string $id) {
        return Reserva::findOrFail($id)->toResource();
    });

    Route::post('/reservas', [ReservaController::class, 'apiNewReserva']);

    Route::put('/reservas/{id}', [ReservaController::class, 'apiUpdateReserva']);

    Route::delete('/reservas/{id}', [ReservaController::class, 'apiDeleteReserva']);
});
