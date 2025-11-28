<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reservas')->insert(['telefono' => '656236999', 'fecha' => '2025-11-28', 'hora' => '15:00', 'mesa_id' => 5,
            'user_id' => 1, 'numpersonas' => 3, 'estado' => 'pendiente', 'created_at' => now(),
            'updated_at' => now() ]);

        DB::table('reservas')->insert(['telefono' => '666995544', 'fecha' => '2025-11-28', 'hora' => '15:00', 'mesa_id' => 7,
            'user_id' => 2, 'numpersonas' => 2, 'estado' => 'pendiente', 'created_at' => now(),
            'updated_at' => now() ]);


    }
}
