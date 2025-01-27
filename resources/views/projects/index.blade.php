<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inici - StudyXP</title>
    <link rel="icon" href="{{ asset('css/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
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

            <p class="hola">Hola, {{ auth()->user()->name }}</p>
        </div>
        <div class="logo">
            <img src="{{ asset('css/logo.png') }}" alt="StudyXP Logo">
        </div>
        <nav class="bottom-menu">
            <ul>
                @if(auth()->user()->is_profesor == 0)
                    <li>
                        <i class='bx bxs-user'></i>
                        <a href="/users/{{ auth()->user()->id_user }}">
                            <button class="stats-button" type="submit">Les meves dades</button>
                        </a>
                    </li>
                @endif
                <li>
                    <i class='bx bx-log-out'></i>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="stats-button" type="submit">Tancar sessió</button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header-content">
            <h2>BENVINGUT</h2>
            @if(auth()->user()->is_profesor)
                <button class="stats-button">Crear Projectes</button>
                <button class="stats-button">Alumnes</button>
                <button class="stats-button">Items</button>
            @else
                <button class="stats-button">Estadístiques Activitats</button>
            @endif
        </div>

        <div class="activities">
            <h2>Llistat Projectes</h2>
            <div class="activities-list">
                @foreach($projects as $project)

                        <div class="activity">
                            <a href="/projects/{{ $project->id_project}}" class="underline">{{$project->title}}</a>
                            @if(auth()->user()->is_profesor)
                                <a href="/project/{{ $project->id_project }}/edit"><button class="stats-button">Modificar</button></a>

                                <form action="/projects/{{ $project->id_project }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="stats-button" type="submit")>Eliminar</button>
                                </form>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </main>
</div>
</body>
</html>
