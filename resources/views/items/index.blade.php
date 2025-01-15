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
<a href="/items/create"><button>Crear projecte</button></a>
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
    <a href="/items/create"><button>Crear Item</button></a>
    @foreach($items as $item)
        <tr>
            <td><img height="100px" src="{{ asset('storage/' . $item->icon) }}" alt="Icono de {{ $item->name }}"></td>
            <td>{{$item->title}}</td>
            <td>{{$item->description}}</td>
            <td>
                <button><a href="/items/{{ $item->id_item}}">Ver Detalles</a></button>
                <a href="/items/{{ $item->id_item}}">Cambiar icono</a>
                <form action="/items/{{ $item->id_item }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit")>Eliminar</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
