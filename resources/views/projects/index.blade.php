<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inici Professor - StudyXP</title>
    <link rel="icon" href="{{ asset('css/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="profile">
            <div class="avatar"></div>
            <p>Hola, {{auth()->user()->name}}</p>
        </div>
        <div class="logo">
            <img src="{{asset('css/logo.png')}}" alt="StudyXP Logo">
        </div>
        <nav class="bottom-menu">
            <ul>
                @if(auth()->user()->is_profesor == 0)
                    <li>
                        <i class='bx bxs-user'></i>
                        <a href="#">Les meves dades</a>
                    </li>
                @endif
                <li>
                    <i class='bx bx-log-out'></i>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">Cerrar sesión</button>
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
            @endif
        </div>

        <div class="activities">
            <h2>Llistat Projectes</h2>
            <div class="activities-list">
                @foreach($projects as $project)
                    <a href="/projects/{{ $project->id_project}}" class="activity-link">
                        <div class="activity">
                            {{$project->title}}
                            <a href="/project/{{ $project->id_project }}/edit"php ><button class="stats-button">Modificar</button></a>
                            <form action="/projects/{{ $project->id_project }}" method="POST" class="stats-button">
                                @csrf
                                @method('DELETE')
                                <button type="submit")>Eliminar</button>
                            </form>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @if(auth()->user()->is_profesor)
            <div class="evaluation-section">
                <div class="evaluation-button">ALUMNES</div>
                <div class="evaluation-button">ITEMS</div>
            </div>
        @endif
    </main>
</div>
</body>
</html>
