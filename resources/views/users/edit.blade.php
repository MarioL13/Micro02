<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>
<body>
<h1>Editando a {{$user->name}}</h1>
<a href="{{ route('users.index') }}">Volver</a>
<form action="{{ route('users.update', ['user' => $user->id_user]) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <label for="name">Nom:</label>
    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
    @error('name')
    <span class="text-danger">{{ $message }}</span>
    @enderror

    <label for="surname">Cognoms:</label>
    <input type="text" name="surname" id="surname" value="{{ old('surname', $user->surname) }}" required>
    @error('surname')
    <span class="text-danger">{{ $message }}</span>
    @enderror

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
    @error('email')
    <span class="text-danger">{{ $message }}</span>
    @enderror

    <label for="birthdate">Naixement:</label>
    <input type="date" name="birthdate" id="birthdate" value="{{ old('birthdate', $user->birthdate) }}" required>
    @error('birthdate')
    <span class="text-danger">{{ $message }}</span>
    @enderror

    <label for="dni">DNI:</label>
    <input type="text" name="dni" id="dni" value="{{ old('dni', $user->dni) }}" required>
    @error('dni')
    <span class="text-danger">{{ $message }}</span>
    @enderror

    <label for="foto">Foto:</label>
    <input type="file" name="foto" id="foto">
    @error('foto')
    <span class="text-danger">{{ $message }}</span>
    @enderror

    <input type="submit" name="editar" id="editar" value="Editar Usuario">
</form>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>
