<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projecte Informació - StudyXP</title>
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

    <main class="main-content">
        <div class="header-content">
            <h2>Detalls d'Item: {{$item->title}}</h2>
        </div>

        <div class="activities">
            <div class="activity">
                <p><strong>Título: </strong>{{$item->title}}</p>
                <p><strong>Descripción: </strong>{{$item->description}}</p>
                <img src="{{ asset('storage/' . $item->icon) }}" alt="Icono de {{ $item->icon }}">
            </div>
        </div>


        <div class="save-button">
            <a href="{{ route('items.index') }}">
                <button class="save-button">Tornar</button>
            </a>
        </div>
        </main>
    </div>
</body>
</html>
