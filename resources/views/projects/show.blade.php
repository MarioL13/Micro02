<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proyecto</title>
</head>
<body>
<h1>Detalles de {{$project->title}}</h1>
<a href="{{ route('projects.index') }}">Volver</a>
<ul>
    <li><strong>Título: </strong>{{$project->title}}</li>
    <li><strong>Descripción: </strong>{{$project->description}}</li>
    <li><strong>Fecha Creación: </strong>{{$project->creation_date}}</li>
    <li><strong>Fecha Límite: </strong>{{$project->limit_date}}</li>
</ul>

<h3>Usuarios asignados:</h3>
<ul>
    @foreach ($project->users as $user)
        <li>{{ $user->name }} ({{ $user->email }})</li>
    @endforeach
</ul>

</body>
</html>
