<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - StudyXP</title>
    <link rel="icon" href="{{ asset('css/logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body id="body-login">
<div class="login-container">
    <h1>LOGIN</h1>
    <div class="content-wrapper">
        <div class="logo">
            <img src="{{ asset('css/logo.png') }}" alt="StudyXP Logo">
        </div>
        <div class="form-wrapper">
            <form method="POST" action="{{ url('/login') }}">
                @csrf
                <div class="input-group">
                    <i class='bx bxs-user'></i>
                    <input type="text" name="email" placeholder="Usuario" required>
                </div>
                <div class="input-group">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" name="password" placeholder="Contraseña" required>
                </div>

                @if ($errors->any())
                    <div>
                        <p class="error-message">{{ $errors->first() }}</p>
                    </div>
                @endif

                <button type="submit" class="login-button">Log In</button>
            </form>
        </div>
    </div>
</div>
</body>

</html>
