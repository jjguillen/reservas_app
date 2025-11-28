<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mesa_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->date('fecha');
            $table->enum('hora', ['13:00', '15:00', '20:00', '22:00']);
            $table->tinyInteger('numpersonas');
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
