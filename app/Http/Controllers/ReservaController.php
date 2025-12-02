<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use App\Models\Reserva;
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

    public function buscarDisponibilidad(Request $request)  {
        //Validar datos del formulario
        $request->validate([
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'personas' => 'required|integer|min:1',
        ]);

        $fecha = $request->input('fecha');
        $hora = $request->input('hora');
        $num_personas = $request->input('personas');

        //Lógica para buscar disponibilidad (a implementar)
        // Obtener todas las mesas
        $mesas = Mesa::all();

        // Filtrar mesas ocupadas en esa fecha y hora
        $ocupadas = Reserva::where('fecha', $fecha)
            ->where('hora', $hora)
            ->pluck('mesa_id')
            ->toArray();

        // Mesas libres
        $libres = $mesas->whereNotIn('id', $ocupadas);

        echo "Buscando ...<br>";
        foreach ($libres as $libre) {
            echo $libre . "<br>";
        }
    }

}
