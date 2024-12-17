<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proyectos</title>
</head>
<body>
<h1>Proyectos</h1>
<table border="1">
    <thead>
    <tr>
        <th>Titulo</th>
        <th>Fecha Limite</th>
        <th>Nota</th>
        <th>Descripción</th>
    </tr>
    </thead>
    <tbody>
    @foreach($projects as $project)
        <tr>
            <td>{{$project->title}}</td>
            <td>{{$project->date_limit}}</td>
            <td>{{$project->note}}</td>
            <td>{{$project->desc}}</td>
            <td>
                <a href="/projects/{{ $project->id_project}}">Ver Detalles</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
