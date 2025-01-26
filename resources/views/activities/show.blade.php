<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalls Activitat - StudyXP</title>
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
                        <a href="/users/{{ auth()->user()->id_user }}"><button class="stats-button" type="submit">Les meves dades</button></a>
                    </li>
                @endif
                <li>
                    <i class='bx bx-log-out'></i>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="stats-button" type="submit">Tancar sessió</button></form>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header-content">
            <h2>Detalls Activitat: {{ $activity->title }}</h2>
            <a href="{{ route('activities.grade', $activity->id_activity) }}">
                <button class="stats-button">Posar Notas</button>
            </a>
        </div>

        <section class="activities info-act">
            <p><strong>Nom: </strong>{{ $activity->title }}</p>
            <p><strong>Descripció: </strong>{{ $activity->description }}</p>
            <p><strong>Data Límit: </strong>{{ $activity->limit_date }}</p>
            <p><strong>Estat: </strong>{{ $activity->state == 1 ? 'Actiu' : 'Inactiu' }}</p>
        </section>

        <section class="assigned-items">
            <h2>Items Assignats:</h2>
            <div class="evaluation-items">
                @forelse ($activity->items as $item)
                    <div class="item">
                        <img class="round-image" src="{{ asset('storage/' . $item->icon) }}" alt="Icono de {{ $item->name }}">
                        <span>{{ $item->title }} - {{ $item->pivot->percentage }}%</span>
                    </div>
                @empty
                    <p>No hay ítems asignados a esta actividad.</p>
                @endforelse
            </div>
            <a href="{{ route('activities.items', $activity->id_activity) }}">
                <button class="stats-button">Assignar Items</button>
            </a>
        </section>
        <div class="save-button">
            <a href="{{ route('projects.show', $activity->project->id_project) }}">
                <button class="save-button">Tornar al Projecte</button>
            </a>
        </div>
    </main>
</div>
</body>

</html>
