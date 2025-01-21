<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Main</title>
</head>
<body>
    <h1>Pagina principal </h1>

    @if(auth()->user()->is_profesor)
       <button><a href="../users">Ver usuarios</a></button>
        <button><a href="../items">Ver Items</a></button>
    @endif
    <button><a href="../projects">Ver projectos</a></button>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Cerrar sesión</button>
    </form>
</body>
</html>
