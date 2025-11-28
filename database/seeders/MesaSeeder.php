<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mesas')->insert(['capacidad' => 8, 'tipo' => 'interior', 'notas' => 'Junto ventana']);
        DB::table('mesas')->insert(['capacidad' => 6, 'tipo' => 'interior', 'notas' => 'Accesible']);
        DB::table('mesas')->insert(['capacidad' => 6, 'tipo' => 'terraza', 'notas' => 'Accesible']);
        DB::table('mesas')->insert(['capacidad' => 4, 'tipo' => 'privada', 'notas' => 'Clientes importantes']);
        DB::table('mesas')->insert(['capacidad' => 4, 'tipo' => 'terraza', 'notas' => 'Accesible']);
        DB::table('mesas')->insert(['capacidad' => 2, 'tipo' => 'interior', 'notas' => 'Romántica']);
        DB::table('mesas')->insert(['capacidad' => 2, 'tipo' => 'terraza', 'notas' => 'Atardecer']);
    }
}
