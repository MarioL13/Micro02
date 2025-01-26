<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignar Ítems - StudyXP</title>
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
            <h2>Assignar Ítems a l'Activitat: {{ $activity->title }}</h2>
            <a href="{{ route('activities.show', $activity->id_activity) }}">
                <button class="stats-button">Tornar a l'Activitat</button>
            </a>
        </div>

        <div class="activities">
            <div class="activities-list">
                <form method="POST" action="{{ route('activities.assignItems', $activity->id_activity) }}">
                    @csrf
                    @foreach ($projectItems as $item)
                        <div class="activity">
                            <label>
                                <input type="checkbox" name="items[]" value="{{ $item->id_item }}"
                                    {{ in_array($item->id_item, array_keys($assignedItems)) ? 'checked' : '' }}>
                                <span class="underline">{{ $item->title }}</span>
                            </label>
                            <label for="percentage_{{ $item->id_item }}">Percentatge:</label>
                            <input type="number" name="percentages[{{ $item->id_item }}]"
                                   value="{{ old('percentages.' . $item->id_item, $assignedItems[$item->id_item] ?? 0) }}"
                                   min="0" max="100" step="1">
                        </div>
                    @endforeach
                    <div>
                        <button type="submit" class="evaluation-button">Actualitzar Assignacions</button>
                    </div>
                </form>
            </div>
        </div>

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
