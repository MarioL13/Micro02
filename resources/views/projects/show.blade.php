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
<button><a href="/project/{{ $project->id_project }}/veralumnos">Asignar Alumnos</a></button>
<ul>
    @foreach ($project->users as $user)
        <li>{{ $user->name }} ({{ $user->email }})</li>
    @endforeach
</ul>

<button><a href="/project/{{ $project->id_project }}/veritems">Asignar Items</a></button>
<ul>
    @foreach ($project->items as $item)
        <li>
            <img height="25px" src="{{ asset('storage/' . $item->icon) }}" alt="Icono de {{ $item->title }}">
            {{ $item->title }} - {{ $item->pivot->percentage }}%
        </li>
    @endforeach
</ul>


<h3>Actividades:</h3>
<a href="{{ route('activities.create', $project->id_project) }}" class="btn btn-primary">Crear Actividad</a>
<table class="table" border = "1px">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($project->activities as $activity)
        <tr>
            <td>{{ $activity->title }}</td>
            <td>{{ $activity->description }}</td>
            <td>
                <a href="{{ route('activities.show', $activity->id_activity) }}" class="btn btn-info">Ver</a>
                <a href="{{ route('activities.edit', $activity->id_activity) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('activities.destroy', $activity->id_activity) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta actividad?')">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
