<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proyecto</title>
</head>
<body>
<h1>Detalles de {{$project->title}}</h1>
<ul>
    <li><strong>Titulo: </strong>{{$project->title}}</li>
    <li><strong>Fecha Limite: </strong>{{$project->date_limit}}</li>
    <li><strong>Nota: </strong>{{$project->note}}</li>
    <li><strong>Descripcion: </strong>{{$project->desc}}</li>
</ul>
<a href="/">Volver</a>
</body>
</html>