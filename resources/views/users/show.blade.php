<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Les Meves Dades - StudyXP</title>
    <link rel="icon" href="{{ asset('css/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
<div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <header class="header">
            <div class="profile">
                <div class="avatar"></div>
                <p>Hola, {{ auth()->user()->name }}</p>
            </div>
            <div class="logo">
                <img src="{{ asset('css/logo.png') }}" alt="Logo SXP StudyXP">
            </div>
        </header>
        <nav class="bottom-menu">
            <ul>
                <li>
                    <i class='bx bxs-user'></i>
                    <a href="#">Les meves dades</a>
                </li>
                <li>
                    <i class='bx bx-log-out'></i>
                    <a href="{{ route('logout') }}">Log Out</a>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <h1>Les Meves Dades</h1>

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
                    <div class="profile-image">
                        <img src="{{ asset('storage/' . $user->image) }}" alt="Foto de {{ $user->name }}">
                    </div>
                </div>
            </div>
            <div class="save-button">
                @if(auth()->user()->is_profesor)
                    <a href="{{ route('users.index') }}" class="save-button">Tornar</a>
                @else
                    <a href="{{ route('welcome') }}" class="save-button">Tornar</a>
                @endif
            </div>

        </section>
    </main>
</div>
</body>

</html>
