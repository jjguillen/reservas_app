<?php

use App\Http\Resources\MesaResource;
use App\Models\Mesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/mesas', function () {
    return MesaResource::collection(Mesa::all());
});

Route::get('/mesas/{id}', function (string $id) {
    return Mesa::findOrFail($id)->toResource();
});
