<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dades Alumne - Study XP</title>
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

            <p class="hola">Hola, {{ auth()->user()->name }}</p>
        </div>
        <div class="logo">
            <img src="{{asset('css/logo.png')}}" alt="StudyXP Logo">
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
            <h2>Dades Alumne: {{ $user->name }}</h2>
        </div>

        <!-- Dades Alumne -->
        <section class="student-data">
            <div class="data-card">
                <div class="left-section">
                    <h2>Dades Alumne</h2>
                    <p><strong>Nom:</strong> {{ $user->name }}</p>
                    <p><strong>Cognoms:</strong> {{ $user->surname }}</p>
                    <p><strong>Data naixement:</strong> {{ $user->birthdate }}</p>
                </div>
                <div class="right-section">
                    <h2>Imatge Perfil</h2>
                    <div class="profile">
                        @if($user->image)
                            <img class="avatar" src="{{ asset('storage/' . $user->image) }}" alt="Icono de {{ $user->name }}">
                        @else
                            <div class="avatar"></div>
                        @endif
                    </div>
                    @if (auth()->user()->id_user == $user->id_user)
                        <form action="{{ route('users.updatePhoto', $user->id_user) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label for="foto">Seleccionar nueva foto:</label>
                            <input type="file" name="foto" id="foto" accept="image/*" required>
                            <button type="submit" class="stats-button">Actualizar foto</button>
                        </form>
                    @endif
                </div>
            </div>
            <div class="save-button">
                @if(auth()->user()->is_profesor)
                    <a href="{{ route('users.index') }}">
                        <button class="save-button">Tornar</button>
                    </a>
                @else
                    <a href="{{ route('welcome') }}">
                        <button class="save-button">Tornar</button>
                    </a>
                @endif
            </div>
        </section>
    </main>
</div>
</body>
</html>
