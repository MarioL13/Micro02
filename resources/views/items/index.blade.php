<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items - Study XP</title>
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
            <img src="{{ asset('css/logo.png') }}" alt="Logo">
        </div>
        <nav class="bottom-menu">
            <ul>
                <li>
                    <i class='bx bx-log-out'></i>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="stats-button" type="submit">Cerrar sesión</button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header-content">
            <h2>Items</h2>
            <a href="/items/create"><button class="stats-button">Crear Item</button></a>
        </div>

        <div class="activities">
            @foreach($items as $item)
                <div class="activity">
                    <div class="activity-info">
                        <p> {{ $item->title }}</p>
                    </div>
                    <div class="activity-actions">
                        <a href="/items/{{ $item->id_item }}"><button class="stats-button">Ver Detalles</button></a>
                        <a href="/items/{{ $item->id_item }}/edit"><button class="stats-button">Editar</button></a>
                        <form action="/items/{{ $item->id_item }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="stats-button">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</div>
</body>

</html>
