<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projecte Informació - StudyXP</title>
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
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header-content">
            <h2>Detalls del Projecte</h2>
            @if(auth()->user()->is_profesor)
                <a href="/project/{{ $project->id_project }}/veralumnos">
                    <button class="stats-button">Assignar Alumnes</button>
                </a>
                <a href="/project/{{ $project->id_project }}/veritems">
                    <button class="stats-button">Assignar Items</button>
                </a>
                <a href="{{ route('activities.create', $project->id_project) }}">
                    <button class="stats-button">Crear Activitat</button>
                </a>
            @else
                <a href="{{ route('project.stats', $project->id_project) }}">
                    <button class="stats-button">Estadistiques Projecte</button>
                </a>
            @endif
        </div>

        <!-- Items Avaluatius -->
        <section class="assigned-items">
            <h2>Items Avaluatius:</h2>
            <div class="evaluation-items">
                @foreach ($project->items as $item)
                    <div class="item">
                        <img class="round-image" src="{{ asset('storage/' . $item->icon) }}" alt="Icono de {{ $item->name }}">
                        <span>{{ $item->title }} - {{ $item->pivot->percentage }}%</span>
                    </div>
                @endforeach
            </div>
        </section>

        <!-- Informació Projecte -->
        <h2>Informació Projecte</h2>
        <section class="activities info-act">
            <p><strong>Títol: </strong>{{ $project->title }}</p>
            <p><strong>Descripció: </strong>{{ $project->description }}</p>
            <p><strong>Data Inicial: </strong>{{ $project->creation_date }}</p>
            <p><strong>Data Final: </strong>{{ $project->limit_date }}</p>
        </section>

        <!-- Activitats -->
        <h2>Activitats:</h2>
        <div class="activities">
            <div class="activities-list">
                @foreach ($project->activities as $activity)
                    <div class="activity">
                        <a class="underline" href="{{ route('activities.show', $activity->id_activity) }}">{{ $activity->title }}</a>
                            <a>{{ $activity->description }}</a>
                        <div class="activity-actions">
                            <a {{ route('activities.edit', $activity->id_activity) }}"><button class="stats-button">Editar</button></a>
                            <form action="{{ route('activities.destroy', $activity->id_activity) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="stats-button" onclick="return confirm('¿Estás seguro de eliminar esta actividad?')">Eliminar</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="save-button">
            <a href="{{ route('projects.index') }}">
                <button class="save-button">Tornar</button>
            </a>
        </div>
    </main>
</div>
</body>

</html>
