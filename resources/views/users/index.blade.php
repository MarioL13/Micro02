<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuaris - StudyXP</title>
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
            <h2>Usuaris</h2>
            <a href="{{ route('welcome') }}"><button class="stats-button">Volver</button></a>

            <a href="/users/create"><button class="stats-button">Crear Usuari</button></a>
            <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="csv_file">Archivo CSV:</label>
                    <input type="file" name="csv_file" id="csv_file" required>
                </div>
                <button type="submit">Importar Usuarios</button>
            </form>
        </div>

        <div class="activities">
            <h2>Usuaris Actius</h2>
            <div class="activities">
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

            <h2>Usuaris Desactivats</h2>
            <div class="activities-list">
                @foreach($users as $user)
                    @if($user->state == 0 && $user->is_profesor != 1)
                        <div class="activity">
                            <div class="activity">
                                <img height="100px" src="{{ asset('storage/' . $user->image) }}" alt="Foto de {{ $user->name }}">
                                <div>
                                    <p><strong>Nom:</strong> {{ $user->name }}</p>
                                    <p><strong>Cognom:</strong> {{ $user->surname }}</p>
                                    <p><strong>Email:</strong> {{ $user->email }}</p>
                                    <p><strong>DNI:</strong> {{ $user->dni }}</p>
                                </div>
                            </div>
                            <div class="activity-actions">
                                <a href="/users/{{ $user->id_user }}">Veure Detalls</a>

                                <!-- Formulario para activar el usuario -->
                                <form action="/user/{{ $user->id_user }}/state" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit">Activar</button>
                                </form>

                                <form action="/users/{{ $user->id_user }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    @endif
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
