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
<div class="container">
    <h2>Estadístiques del Projecte: {{ $project->title }}</h2>
    <p><strong>Descripció:</strong> {{ $project->description }}</p>
    <p><strong>Data Inicial:</strong> {{ $project->creation_date }}</p>
    <p><strong>Data Final:</strong> {{ $project->limit_date }}</p>

    <h3>Notes per Ítem:</h3>
    <table class="stats-table">
        <thead>
        <tr>
            <th>Ítem</th>
            <th>Nota Mitjana</th>
            <th>% del Projecte</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($stats as $stat)
            <tr>
                <td>{{ $stat['item'] }}</td>
                <td>{{ $stat['averageGrade'] !== null ? $stat['averageGrade'] : 'N/A' }}</td>
                <td>{{ $stat['percentage'] }}%</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h3>Nota Mitjana del Projecte:</h3>
    <p>
        @if ($projectAverage !== null)
            <strong>{{ $projectAverage }}</strong>
        @else
            <em>No hi ha notes suficients per calcular la mitjana.</em>
        @endif
    </p>

    <div class="save-button">
        <a href="{{ route('projects.index') }}">
            <button class="save-button">Tornar</button>
        </a>
    </div>
</div>
</body>
</html>
