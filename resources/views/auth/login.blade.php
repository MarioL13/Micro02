<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<h1>Iniciar Sesión</h1>
<form method="POST" action="{{ url('/login') }}">
    @csrf
    <label for="email">Correo:</label>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Entrar</button>
</form>
@if ($errors->any())
    <div>
        <p>{{ $errors->first() }}</p>
    </div>
@endif
</body>
</html>
