<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuarios</title>
</head>
<body>
<h1>Usuarios</h1>
<a href="/users/create"><button>Crear usuario</button></a>

<!-- Tabla de usuarios activos -->
<h2>Usuarios Activos</h2>
<table border="1">
    <thead>
    <tr>
        <th>Foto</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>DNI</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        @if($user->state == 1)
            <tr>
                <td><img height="100px" src="{{ asset('storage/' . $user->image) }}" alt="Foto de {{ $user->name }}"></td>
                <td>{{$user->name}}</td>
                <td>{{$user->surname}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->dni}}</td>
                <td>
                    <a href="/users/{{ $user->id_user}}">Ver Detalles</a>

                    <!-- Formulario para desactivar el usuario -->
                    <form action="/user/{{ $user->id_user }}/state" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit">Desactivar</button>
                    </form>
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>

<!-- Tabla de usuarios desactivados -->
<h2>Usuarios Desactivados</h2>
<table border="1">
    <thead>
    <tr>
        <th>Foto</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>Email</th>
        <th>DNI</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        @if($user->state == 0)
            <tr>
                <td><img height="100px" src="{{ asset('storage/' . $user->image) }}" alt="Foto de {{ $user->name }}"></td>
                <td>{{$user->name}}</td>
                <td>{{$user->surname}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->dni}}</td>
                <td>
                    <a href="/users/{{ $user->id_user}}">Ver Detalles</a>
                    <form action="/user/{{ $user->id_user }}/state" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit">Activar</button>
                    </form>
                </td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
</body>
</html>
