<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Alumne - Study XP</title>
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
                        <button class="stats-button" type="submit">Tancar sessió</button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header-content">
            <h2>Crear Alumne</h2>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="activities info-act" enctype="multipart/form-data">
            @csrf

            <div>
                <label for="name">Nom:</label>
                <input type="text" name="name" id="name" required class="rounded-input">
            </div>

            <div>
                <label for="surname">Cognoms:</label>
                <input type="text" name="surname" id="surname" required class="rounded-input">
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required class="rounded-input">
            </div>

            <div>
                <label for="password">Contrasenya:</label>
                <input type="password" name="password" id="password" required class="rounded-input">
            </div>

            <div>
                <label for="repeat">Repeteix la Contrasenya:</label>
                <input type="password" name="password_confirmation" id="repeat" required class="rounded-input">
            </div>

            <div>
                <label for="birthdate">Naixement:</label>
                <input type="date" name="birthdate" id="birthdate" required class="rounded-input">
            </div>

            <div>
                <label for="dni">DNI:</label>
                <input type="text" name="dni" id="dni" required class="rounded-input">
            </div>

            <div>
                <label for="foto">Foto:</label>
                <input type="file" name="foto" id="foto" class="rounded-input">
            </div>

            <div>
                <button type="submit" class="stats-button-edit">Crear Alumne</button>
            </div>
        </form>

        <div class="save-button">
            <a href="{{ route('users.index') }}">
                <button class="save-button">Tornar</button>
            </a>
        </div>

        <!-- Display Errors if Any -->
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </main>
</div>
</body>
</html>
