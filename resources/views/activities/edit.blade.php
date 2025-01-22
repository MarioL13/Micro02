<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project</title>
</head>
<body>
<h1>Edit Activity {{$activity->title}}</h1>

<form action="{{ route('activities.update', ['activity' => $activity->id_activity]) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" value="{{ old('title', $activity->title) }}" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description" required>{{ old('description', $activity->description) }}</textarea>
    </div>
    <div>
        <label for="limit_date">Limit Date:</label>
        <input type="date" id="limit_date" name="limit_date" value="{{ old('limit_date', $activity->limit_date) }}" required>
    </div>
    <div>
        <button type="submit">Edit Activity</button>
    </div>
</form>

@if($errors->any())
    <div>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</body>
</html>
