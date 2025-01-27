<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Projecte - Study XP</title>
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
            <h2>Editant Projecte: {{ $project->title }}</h2>
        </div>

        <form action="{{ route('projects.update', ['project' => $project->id_project]) }}" method="POST" class="activities info-act">
            @csrf
            @method('PUT') <!-- Esto indica que el método HTTP será PUT -->

            <div>
                <label for="title">Títol:</label>
                <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required class="rounded-input">
            </div>

            <div>
                <label for="description">Descripció:</label>
                <textarea id="description" name="description" required class="rounded-input">{{ old('description', $project->description) }}</textarea>
            </div>

            <div>
                <label for="limit_date">Data Limit:</label>
                <input type="date" id="limit_date" name="limit_date" value="{{ old('limit_date', $project->limit_date) }}" required class="rounded-input">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="stats-button-edit">Editar Projecte</button>
            </div>
        </form>

        <div class="save-button">
            <a href="{{ route('projects.index') }}">
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
