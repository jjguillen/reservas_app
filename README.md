<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## RESERVAS RESTAURANTE GOURMET

- Usuario → Reserva: un usuario puede tener muchas reservas.  1 -> *
- Mesa → Reserva: una mesa puede tener muchas reservas (en distintos horarios).   1 -> *     
- Reserva → Usuario/Mesa: cada reserva pertenece a un cliente y a una mesa.  

  
## Migraciones
- users
- mesas
- reservas
 
```
# Migración reservas
Schema::create('reservas', function (Blueprint $table) {
$table->id();
$table->foreignId('usuario_id')->constrained()->onDelete('cascade');
$table->foreignId('mesa_id')->constrained()->onDelete('cascade');
$table->date('fecha'); // día de la reserva
$table->time('hora');  // hora de la reserva
$table->unsignedInteger('num_personas'); // cuántos comensales reserva el cliente
$table->string('estado')->default('pendiente'); // pendiente, confirmada, cancelada
$table->timestamps();
});
```
