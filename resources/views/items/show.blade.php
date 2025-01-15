<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$item->title}}</title>
</head>
<body>
<h1>Detalles de {{$item->title}}</h1>
<a href="{{ route('items.index') }}">Volver</a>
<ul>
    <li><strong>Título: </strong>{{$item->title}}</li>
    <li><strong>Descripción: </strong>{{$item->description}}</li>
</ul>
<img src="{{ asset('storage/' . $item->icon) }}" alt="Icono de {{ $item->icon }}">
</body>
</html>
