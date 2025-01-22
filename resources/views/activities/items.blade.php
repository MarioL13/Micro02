<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Ítems a la Actividad</title>
</head>
<body>
<h1>Asignar Ítems a la Actividad: {{ $activity->title }}</h1>
<a href="{{ route('activities.show', $activity->id_activity) }}">Volver a la Actividad</a>

<form method="POST" action="{{ route('activities.assignItems', $activity->id_activity) }}">
    @csrf
    <table>
        <thead>
        <tr>
            <th>Ítem</th>
            <th>Descripción</th>
            <th>Porcentage</th>
            <th>Asignar</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($projectItems as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->description }}</td>
                <td>
                    <input type="number" name="percentages[{{ $item->id_item }}]"
                           value="{{ $assignedItems[$item->id_item] ?? 0 }}">
                </td>
                <td>
                    <input type="checkbox" name="items[]" value="{{ $item->id_item }}"
                        {{ in_array($item->id_item, $assignedItems) ? 'checked' : '' }}>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button type="submit">Guardar Cambios</button>
</form>
</body>
</html>
