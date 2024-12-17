<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear Usuario</title>
</head>
<body>
<form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="name">Nom:</label>
    <input type="text" name="name" id="name" required>  <!-- Cambié name a "name" -->

    <label for="surname">Cognoms:</label>
    <input type="text" name="surname" id="surname" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="password">Contrasenya: </label>
    <input type="password" name="password" id="password" required>

    <label for="repeat">Repeteix la Contrasenya:</label>
    <input type="password" name="repeat" id="repeat" required>

    <label for="birthdate">Naixement:</label>
    <input type="date" name="birthdate" id="birthdate" required>

    <label for="dni">DNI:</label>
    <input type="text" name="dni" id="dni" required>

    <label for="foto">Foto:</label>
    <input type="file" name="foto" id="foto">

    <input type="submit" name="crear" id="crear" value="Crear Usuario">
</form>
</body>
</html>
