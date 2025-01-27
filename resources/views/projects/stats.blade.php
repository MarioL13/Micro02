<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadístiques del Projecte</title>
    <link rel="icon" href="{{ asset('css/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="profile">
            @if(auth()->user()->image)
                <img class="avatar" src="{{ asset('storage/' . auth()->user()->image) }}" alt="Icono de {{ auth()->user()->name }}">
            @else
                <div class="avatar"></div>
            @endif

            <p class="hola">Hola, {{auth()->user()->name}}</p>
        </div>
        <div class="logo">
            <img src="{{asset('css/logo.png')}}" alt="StudyXP Logo">
        </div>
        <nav class="bottom-menu">
            <ul>
                @if(auth()->user()->is_profesor == 0)
                    <li>
                        <i class='bx bxs-user'></i>
                        <a href="/users/{{ auth()->user()->id_user }}"><button class="stats-button" type="submit">Les meves dades</button></a>
                    </li>
                @endif
                <li>
                    <i class='bx bx-log-out'></i>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="stats-button" type="submit">Tancar sessió</button></form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header-content">
            <h2>Estadístiques del Projecte: {{ $project->title }}</h2>
        </div>

        <!-- Project Information -->
        <section class="project-info">
            <p><strong>Descripció:</strong> {{ $project->description }}</p>
            <p><strong>Data Inicial:</strong> {{ $project->creation_date }}</p>
            <p><strong>Data Final:</strong> {{ $project->limit_date }}</p>
        </section>

        <!-- Notes per Ítem -->
        <h3>Notes per Ítem:</h3>
        <section class="stats-table-section">
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
        </section>

        <!-- Nota Mitjana del Projecte -->
        <h3>Nota Mitjana del Projecte:</h3>
        <section class="project-average">
            <p>
                @if ($projectAverage !== null)
                    <strong>{{ $projectAverage }}</strong>
                @else
                    <em>No hi ha notes suficients per calcular la mitjana.</em>
                @endif
            </p>
        </section>

        <!-- Return Button -->
        <div class="save-button">
            <a href="{{ route('projects.index') }}">
                <button class="save-button">Tornar</button>
            </a>
        </div>
    </main>
</div>
</body>

</html>
