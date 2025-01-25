<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="container">
    <h1>Asignar Notas</h1>

    <form action="{{ route('activities.assignGrades', $activity->id_activity) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="id_user" class="form-label">Seleccionar Usuario</label>
            <select name="id_user" id="id_user" class="form-select" required>
                <option value="" disabled selected>-- Selecciona un Usuario --</option>
                @foreach ($activity->project->users as $user)
                    <option value="{{ $user->id_user }}">{{ $user->name }} {{ $user->surname }}</option>
                @endforeach
            </select>
        </div>

        <h3>Ítems</h3>
        @foreach ($assignedItems as $item)
            <div class="mb-3">
                <label for="grade_{{ $item->id_item }}" class="form-label">{{ $item->title }}</label>
                <input type="number" name="grades[{{ $item->id_item }}]" id="grade_{{ $item->id_item }}" value="{{ old('grades.' . $item->id_item) }}" min="0" max="10" step="0.1">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Guardar Notas</button>
    </form>
</div>
</body>
</html>
