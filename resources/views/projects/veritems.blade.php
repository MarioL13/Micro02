<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asignar Alumnos</title>
</head>
<body>
<h1>Asignar Items al Proyecto: {{ $project->title }}</h1>

<form action="/project/{{ $project->id_project }}/assign-items" method="POST">
    @csrf
    <h3>Asignar Items</h3>

    <ul>
        @foreach ($items as $item)
            <li>
                <img height="25px" src="{{ asset('storage/' . $item->icon) }}" alt="Icono de {{ $item->title }}">
                {{ $item->title }}

                <!-- Campo de porcentaje con el valor actual si existe -->
                <input type="number" name="percentages[{{ $item->id_item }}]"
                       value="{{ old('percentages.' . $item->id_item, $assignedItems[$item->id_item] ?? 0) }}"
                       min="0" max="100" step="1">
            </li>
        @endforeach
    </ul>

    <button type="submit">Asignar Items</button>
</form>
@if(session('error'))
    <div>
        <strong>{{ session('error') }}</strong>
    </div>
@endif
</body>
</html>
