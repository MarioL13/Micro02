<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Calificaciones de la Actividad: {{ $activity->title }}</h1>
<p>Descripción: {{ $activity->description }}</p>
<p>Fecha Límite: {{ $activity->limit_date }}</p>

<h2>Ítems Asignados</h2>
<table>
    <thead>
    <tr>
        <th>Ítem</th>
        <th>Porcentaje</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($assignedItems as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->pivot->percentage }}%</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
