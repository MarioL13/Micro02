<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignar Notes - StudyXP</title>
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
            <h2>Assignar Notes a l'Activitat: {{ $activity->title }}</h2>
            <a href="{{ route('activities.show', $activity->id_activity) }}">
                <button class="stats-button">Tornar a l'Activitat</button>
            </a>
        </div>

        <form action="{{ route('activities.assignGrades', $activity->id_activity) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="id_user" class="form-label">Seleccionar Usuari</label>
                <select name="id_user" id="id_user" class="form-select" required>
                    <option value="" disabled selected>-- Selecciona un Usuari --</option>
                    @foreach ($activity->project->users as $user)
                        <option value="{{ $user->id_user }}">{{ $user->name }} {{ $user->surname }}</option>
                    @endforeach
                </select>
            </div>

            <h3>Ítems</h3>
            @foreach ($assignedItems as $item)
                <div class="activity">
                    <label for="grade_{{ $item->id_item }}" class="form-label">{{ $item->title }}</label>
                    <input type="number" name="grades[{{ $item->id_item }}]" id="grade_{{ $item->id_item }}" value="{{ old('grades.' . $item->id_item) }}" min="0" max="10" step="0.1">
                </div>
            @endforeach

            <div>
                <button type="submit" class="evaluation-button">Guardar Notes</button>
            </div>
        </form>

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
