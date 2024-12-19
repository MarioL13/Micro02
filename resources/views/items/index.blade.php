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
        <th>Icono</th>
        <th>Titulo</th>
        <th>Descripcion </th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $item)
        <tr>
            <td>{{$item->icon}}</td>
            <td>{{$item->title}}</td>
            <td>{{$item->description}}</td>
            <td>
                <a href="/items/{{ $item->id_item}}">Cambiar icono</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
