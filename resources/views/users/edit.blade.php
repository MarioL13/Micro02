<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Alumne - Study XP</title>
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
            <h2>Editant a l'Alumne: {{ $user->name }}</h2>
        </div>

        <!-- Formulario para editar usuario -->
        <form action="{{ route('users.update', ['user' => $user->id_user]) }}" method="POST" enctype="multipart/form-data" class="activities info-act">
            @csrf
            @method('PUT')

            <div>
                <label for="name">Nom:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="rounded-input">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="surname">Cognoms:</label>
                <input type="text" name="surname" id="surname" value="{{ old('surname', $user->surname) }}" required class="rounded-input">
                @error('surname')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="rounded-input">
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="birthdate">Naixement:</label>
                <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate', $user->birthdate) }}" required class="rounded-input">
                @error('birthdate')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="dni">DNI:</label>
                <input type="text" name="dni" id="dni" value="{{ old('dni', $user->dni) }}" required class="rounded-input">
                @error('dni')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="foto">Foto:</label>
                <input type="file" name="foto" id="foto" class="rounded-input">
                @error('foto')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button type="submit" class="stats-button-edit">Editar Usuari</button>
            </div>
        </form>

        <div class="save-button">
            <a href="{{ route('users.index') }}">
                <button class="save-button">Tornar</button>
            </a>
        </div>

        <!-- Display Errors if Any -->
        @if($errors->any())
            <div class="error-message">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </main>
</div>
</body>

</html>
