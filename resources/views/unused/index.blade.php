<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proyectos</title>
</head>
<body>
<h1>Proyectos</h1>
@if(auth()->user()->is_profesor)
    <a href="/projects/create"><button>Crear projecte</button></a>
@endif
<a href="/"><button>Volver</button></a>
<table border="1">
    <thead>
    <tr>
        <th>Titulo</th>
        <th>Descripción</th>
        <th>Fecha de creacion</th>
        <th>Fecha Limite</th>
        <th>Acciones</th>
        @if(auth()->user()->is_profesor == false)
        <th>Nota</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($projects as $project)
        <tr>
            <td>{{$project->title}}</td>
            <td>{{$project->description}}</td>
            <td>{{$project->creation_date}}</td>
            <td>{{$project->limit_date}}</td>
            <td>
                <button><a href="/projects/{{ $project->id_project}}">Ver Detalles</a></button>
                <form action="/projects/{{ $project->id_project }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit")>Eliminar</button>
                </form>
                <button><a href="/project/{{ $project->id_project }}/edit">Editar Proyecto</a></button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
