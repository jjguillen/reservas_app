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
        //Reservas futuras, las que ya han pasado no se muestran
        $reservas = $user->reservas->where('fecha', '>=', now()->toDateString());

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
    public function store(Request $request) {
        $mesa_id = $request->input('mesa_id');
        $fecha = $request->input('fecha');
        $hora = $request->input('hora');
        $num_personas = $request->input('num_personas');
        $telefono = $request->input('telefono');

        Reserva::create([ 'mesa_id' => $mesa_id,
            'fecha' => $fecha,
            'hora' => $hora,
            'user_id' => auth()->id(),
            'numpersonas' => $num_personas,
            'telefono' => $telefono,
            'estado' => 'pendiente']);

        return redirect()->route('mis_reservas');
    }

    public function buscarDisponibilidad(Request $request)  {
        //Validar datos del formulario
        $request->validate([
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'personas' => 'required|integer|min:1',
            'telefono' => 'required|string|min:9'
        ]);

        $fecha = $request->input('fecha');
        $hora = $request->input('hora');
        $num_personas = $request->input('personas');
        $telefono = $request->input('telefono');

        //Lógica para buscar disponibilidad de mesas
        // Obtener todas las mesas
        // capacidad - numpersona <= 2 --> dos huecos se pueden dejar en la mesa
        $mesas = Mesa::where('capacidad', '>=', $num_personas)
                        ->where('capacidad', '<=', (2 + $num_personas) )->get(); //SQL

        // Filtrar mesas ocupadas en esa fecha y hora (SQL)
        $ocupadas = Reserva::where('fecha', $fecha)
            ->where('hora', $hora)
            ->pluck('mesa_id')  // Obtener solo los IDs de las mesas ocupadas
            ->toArray();

        // Mesas libres
        $libres = $mesas->whereNotIn('id', $ocupadas); // No SQL, se trabaja en memoria

        return view('reservas.search', compact('libres', 'telefono','fecha', 'hora', 'num_personas'));
    }

    public function cancelar($reserva) {
        $reserva = Reserva::findOrFail($reserva);

        //Mejor hacerlo con policies
        //Verificar que la reserva pertenece al usuario logueado
        if (!auth()->user()->admin) {
            if ($reserva->user_id != auth()->id()) {
                abort(403);
            }
        }

        $reserva->estado = 'cancelada';
        $reserva->save();

        if (auth()->user()->admin) {
            return redirect()->route('reservas.pendientes');
        } else {
            return redirect()->route('mis_reservas');
        }
    }

    /**
     * Solo puede confirmar reservas el usuario administrador
     * @param $reserva
     * @return \Illuminate\Http\RedirectResponse
     */
    public function confirmar($reserva) {
        $reserva = Reserva::findOrFail($reserva);

        //Mejor hacerlo con policies
        //Verificar que la reserva pertenece al usuario logueado
        if (!auth()->user()->admin) {
                abort(403);
        }

        if ($reserva->estado == 'pendiente') {
            $reserva->estado = 'confirmada';
            $reserva->save();
        }

        return redirect()->route('reservas.pendientes');
    }

    public function pendientes() {
        $reservas = Reserva::where('fecha', '>=', now()->toDateString())->get();
        return view('reservas.pendientes', compact('reservas'));
    }

    public function filtrar(Request $request) {
        $fecha = $request->input('fecha');
        $estado = $request->input('estado');

        if ($estado == 'todas') {
            $estados = ['pendiente', 'confirmada', 'cancelada'];
            $reservas = Reserva::where('fecha', '=', $fecha)->
                whereIn('estado', $estados)->get();
        } else {
            $reservas = Reserva::where('fecha', '=', $fecha)->
            where('estado','=',$estado)->get();
        }

        return view('reservas.pendientes', compact('reservas'));
    }


}
