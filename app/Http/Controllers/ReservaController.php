<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ReservaController extends Controller
{

    /**
     * Mostrar todas las reservas del usuario logueado
     */
    public function index()  {
        //Mostrar todas las reservas del usuario logueado
        $user = auth()->user();
        $reservas = $user->reservas;

        return view('reservas.index', compact('reservas', 'user'));
    }

    /**
     * Mostrar formulario para crear una nueva reserva
     */
    public function new() {
        return view('reservas.new');
    }


    /**
     * Almacenar una nueva reserva
     */
    public function store() {
        echo "Crear reserva";
    }

}
