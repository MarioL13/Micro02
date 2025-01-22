<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles de Actividad</title>
</head>
<body>
<h1>Detalles de la Actividad: {{ $activity->title }}</h1>
<a href="{{ route('projects.show', $activity->project->id_project) }}">Volver al Proyecto</a>
<ul>
    <li><strong>Nombre:</strong> {{ $activity->title }}</li>
    <li><strong>Descripción:</strong> {{ $activity->description }}</li>
    <li><strong>Fecha Límite:</strong> {{ $activity->limit_date }}</li>
    <li><strong>Estado:</strong> {{ $activity->state == 1 ? 'Activo' : 'Inactivo' }}</li>
</ul>

<h3>Ítems Asignados:</h3>
<a href="{{ route('activities.items', $activity->id_activity) }}" class="btn btn-primary">Asignar Ítems</a>
<ul>
    @forelse ($activity->items as $item)
        <li>
            {{ $item->title }}
            (Porcentage: {{ $item->pivot->percentage }})
        </li>
    @empty
        <li>No hay ítems asignados a esta actividad.</li>
    @endforelse
</ul>

</body>
</html>
