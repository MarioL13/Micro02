<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Actividad</title>
</head>
<body>
<div class="container">
    <h2>Estadístiques de l'Activitat: {{ $activity->title }}</h2>
    <p><strong>Descripció:</strong> {{ $activity->description }}</p>
    <p><strong>Data de Finalització:</strong> {{ $activity->limit_date }}</p>

    <h3>Notes per Ítem:</h3>
    <table class="stats-table">
        <thead>
        <tr>
            <th>Ítem</th>
            <th>Nota</th>
            <th>% de l'Activitat</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($stats as $stat)
            <tr>
                <td>{{ $stat['item'] }}</td>
                <td>{{ $stat['grade'] !== null ? $stat['grade'] : 'N/A' }}</td>
                <td>{{ $stat['percentage'] }}%</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h3>Nota Mitjana de l'Activitat:</h3>
    <p>
        @if ($activityAverage !== null)
            <strong>{{ $activityAverage }}</strong>
        @else
            <em>No hi ha notes suficients per calcular la mitjana.</em>
        @endif
    </p>

    <div class="save-button">
        <a href="{{ route('activities.show', $activity->id_activity) }}">
            <button class="save-button">Tornar</button>
        </a>
    </div>
</div>
</body>
</html>
