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
    @foreach($items as $item)
        <div>
            <label>
                <input type="checkbox" name="items[]" value="{{ $item->id_item }}"
                    {{ in_array($item->id_item, $assignedItems) ? 'checked' : '' }}>
                {{ $item->title }}
            </label>
            <label for="percentage_{{ $item->id_item }}">Porcentaje: </label>
            <input type="number" name="percentages[{{ $item->id_item }}]" id="percentage_{{ $item->id_item }}" min="0" max="100">
        </div>
    @endforeach
    <button type="submit">Actualizar Asignaciones</button>
    @if($errors->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</form>
</body>
</html>
