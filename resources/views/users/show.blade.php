<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuario</title>
</head>
<body>
    <h1>Detalles de {{$user->name}} {{$user->surname}}</h1>
    <ul>
        <li><strong>Nombre: </strong>{{$user->name}}</li>
        <li><strong>Apellido: </strong>{{$user->surname}}</li>
        <li><strong>Email: </strong>{{$user->email}}</li>
        <li><strong>Nacimiento: </strong>{{$user->birthdate}}</li>
        <li><strong>DNI: </strong>{{$user->dni}}</li>
        <li><strong>Fecha de Creacion: </strong>{{$user->creation_date}}</li>
    </ul>
    <img src="{{$user->foto}}" alt="">
    <a href="/">Volver</a>
</body>
</html>
