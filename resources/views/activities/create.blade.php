<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Actividad</title>
</head>
<body>
<div>
    <h1>Crear Actividad</h1>
    <form action="{{ route('activities.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_project" value="{{ $projectId }}">

        <div>
            <label for="name" >Nombre de la Actividad</label>
            <input type="text" id="title" name="title" required>
        </div>

        <div>
            <label for="description">Descripción</label>
            <textarea id="description" name="description" rows="3"></textarea>
        </div>

        <div>
            <label for="description">Fecha limite</label>
            <input type="date" id="limit_date" name="limit_date" value="{{ old('limit_date') }}" required>
        </div>

        <button type="submit">Guardar Actividad</button>
        <a href="{{ route('projects.show', $projectId) }}">Cancelar</a>
    </form>
</div>
@if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
