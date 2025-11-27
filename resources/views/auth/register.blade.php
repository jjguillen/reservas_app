<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | Reserva de Restaurantes</title>

    <!-- Bootstrap 5 CDN -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h3 class="text-center mb-4">Crear Cuenta</h3>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <!-- Nombre -->
                        <div class="mb-3">
                            <label class="form-label">Nombre completo</label>
                            <input type="text" name="name" class="form-control" placeholder="Tu nombre" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" name="email" class="form-control" placeholder="email@ejemplo.com" required>
                        </div>

                        <!-- Contraseña -->
                        <div class="mb-3">
                            <label class="form-label">Contraseña (8 caracteres)</label>
                            <input type="password" name="password" class="form-control" placeholder="********" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" class="form-control" required />
                        </div>

                        <!-- Botón -->
                        <button type="submit" class="btn btn-primary w-100">
                            Registrarme
                        </button>
                    </form>

                </div>
            </div>

            <p class="text-center mt-3">
                ¿Ya tienes cuenta? <a href="{{route('login')}}">Inicia sesión</a>
            </p>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</script>
</body>
</html>

