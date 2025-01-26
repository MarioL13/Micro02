<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asignar Items - StudyXP</title>
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
            <h2>Assignar Items al Projecte: {{ $project->title }}</h2>
        </div>
        <div class="activities">
            <div class="activities-list">
                <form action="/project/{{ $project->id_project }}/assign-items" method="POST">
                    @csrf
                    @foreach($items as $item)
                        <div class="activity">
                            <label>
                                <input type="checkbox" name="items[]" value="{{ $item->id_item }}"
                                    {{ $project->items->contains($item) ? 'checked' : '' }}>
                                <span class="underline">{{ $item->title }}</span>
                            </label>
                            <label for="percentage_{{ $item->id_item }}">Porcentaje: </label>
                            <input type="number" name="percentages[{{ $item->id_item }}]"
                                   value="{{ old('percentages.' . $item->id_item, $assignedItems[$item->id_item] ?? 0) }}"
                                   min="0" max="100" step="1">
                        </div>
                    @endforeach
                    <div>
                        <button type="submit" class="evaluation-button">Actualizar Asignaciones</button>
                    </div>
                </form>
            </div>
        </div>

        @if(session('error'))
            <div class="error-message">
                <strong>{{ session('error') }}</strong>
            </div>
        @endif

        <div class="save-button">
            <a href="/projects/{{ $project->id_project}}">
                <button class="save-button">Tornar</button>
            </a>
        </div>
    </main>
</div>
</body>

</html>
