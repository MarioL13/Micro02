<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asignar Alumnos</title>
</head>
<body>
<h1>Asignar Alumnos al Proyecto: {{ $project->title }}</h1>

<form action="/project/{{ $project->id_project }}/assign-students" method="POST">
    @csrf
    @foreach($users as $user)
        <div>
            <label>
                <input type="checkbox" name="students[]" value="{{ $user->id_user }}"
                    {{ in_array($user->id_user, $assignedUsers) ? 'checked' : '' }}>
                {{ $user->name }}
            </label>
        </div>
    @endforeach
    <button type="submit">Actualizar Asignaciones</button>
</form>
</body>
</html>
