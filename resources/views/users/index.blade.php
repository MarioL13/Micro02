<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnes - StudyXP</title>
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
            <h2>Alumnes</h2>
            <a href="/users/create"><button class="stats-button">Crear Usuari</button></a>
        </div>

        <div class="activities">
            <h2>Alumnes Actius</h2>
            <div class="activities-list">
                @foreach($users as $user)
                    @if($user->state == 1 && $user->is_profesor != 1)
                        <div class="activity">
                            <div class="activity-info">
                                <p> {{ $user->name }}</p>
                            </div>
                            <div class="activity-actions">
                                <a href="/users/{{ $user->id_user }}" ><button class="stats-button">Veure Detalls</button></a>
                                <a href="/users/{{ $user->id_user }}/edit"><button class="stats-button">Editar</button></a>
                                <form action="/user/{{ $user->id_user }}/state" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="stats-button">Desactivar</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <h2>Alumnes Desactivats</h2>
            <div class="activities-list">
                @foreach($users as $user)
                    @if($user->state == 0 && $user->is_profesor != 1)
                        <div class="activity">
                            <div class="activity-info">
                                    <p> {{ $user->name }}</p>
                            </div>
                            <div class="activity-actions">
                                <a href="/users/{{ $user->id_user }}"><button class="stats-button">Veure Detalls</button></a>

                                <!-- Formulario para activar el usuario -->
                                <form action="/user/{{ $user->id_user }}/state" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="stats-button">Activar</button>
                                </form>

                                <form action="/users/{{ $user->id_user }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="stats-button">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="activities">
            <h2>Importar Alumnes</h2>
            <div>
                <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="activity">
                        <label for="csv_file">Archivo CSV:</label>
                        <input type="file" name="csv_file" id="csv_file" required>
                        <button type="submit" class="stats-button">Importar Alumnes</button>
                    </div>
                </form>
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
