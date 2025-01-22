<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activitat Informació - StudyXP</title>
    <link rel="icon" href="{{ asset('css/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
            <h2>Detalles del Proyecto</h2>
            @if(auth()->user()->is_profesor)
                <a href="/project/{{ $project->id_project }}/veralumnos">
                    <button class="stats-button">Asignar Alumnos</button>
                </a>
                <a href="/project/{{ $project->id_project }}/veritems">
                    <button class="stats-button">Asignar Items</button>
                </a>
            @else
                <a>
                    <button class="stats-button">Estadístiques Activitat</button>
                </a>
            @endif
        </div>

        <!-- Informació Activitat -->
        <section class="activities info-act">
            <h2>Informació Activitat</h2>
            <p><strong>Títol: </strong>{{ $project->title }}</p>
            <p><strong>Descripció: </strong>{{ $project->description }}</p>
            <p><strong>Data Inicial: </strong>{{ $project->creation_date }}</p>
            <p><strong>Data Final: </strong>{{ $project->limit_date }}</p>
        </section>

        <!-- Items Avaluatius -->
        <section class="assigned-items">
            <h3>Items Avaluatius:</h3>
            <div class="evaluation-items">
                @foreach ($project->items as $item)
                    <div class="item">
                        <img class="round-image" src="{{ asset('storage/' . $item->icon) }}" alt="Icono de {{ $item->name }}">
                        <span>{{ $item->title }} - {{ $item->percentage }}%</span>
                    </div>
                @endforeach
            </div>
        </section>
<button><a href="/project/{{ $project->id_project }}/veritems">Asignar Items</a></button>
<ul>
    @foreach ($project->items as $item)
        <li>
            <img height="25px" src="{{ asset('storage/' . $item->icon) }}" alt="Icono de {{ $item->title }}">
            {{ $item->title }} - {{ $item->pivot->percentage }}%
        </li>
    @endforeach
</ul>


<h3>Actividades:</h3>
<a href="{{ route('activities.create', $project->id_project) }}" class="btn btn-primary">Crear Actividad</a>
<table class="table" border = "1px">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($project->activities as $activity)
        <tr>
            <td>{{ $activity->title }}</td>
            <td>{{ $activity->description }}</td>
            <td>
                <a href="{{ route('activities.show', $activity->id_activity) }}" class="btn btn-info">Ver</a>
                <a href="{{ route('activities.edit', $activity->id_activity) }}" class="btn btn-warning">Editar</a>
                <form action="{{ route('activities.destroy', $activity->id_activity) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta actividad?')">Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


        <div class="save-button">
            <a href="{{ route('projects.index') }}">
                <button class="save-button">Tornar</button>
            </a>
        </div>
    </main>
</div>
</body>

</html>
