<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activitat Informació - StudyXP</title>
    <link rel="icon" href="{{ asset('css/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
<div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="profile">
            <div class="avatar"></div>
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
                        <button class="stats-button" type="submit">Tancar sessió</button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header-content">
            <h2>Assignar Alumnes</h2>
        </div>
        <div class="activities">
            <div class="activities-list">
                <form action="/project/{{ $project->id_project }}/assign-students" method="POST">
                    @csrf
                    @foreach($users as $user)
                        <div class="activity">
                            <label>
                                <input type="checkbox" name="students[]" value="{{ $user->id_user }}"
                                    {{ in_array($user->id_user, $assignedUsers) ? 'checked' : '' }}>
                                <span class="underline">{{ $user->name }}</span>
                            </label>
                        </div>
                    @endforeach
                    <div>
                        <button type="submit" class="evaluation-button">Actualitzar Assignacions</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="save-button">
            <a href="/projects/{{ $project->id_project}}">
                <button class="save-button">Tornar</button>
            </a>
        </div>
    </main>
</div>
</body>

</html>
