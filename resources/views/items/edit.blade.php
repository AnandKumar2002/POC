<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Items</title>
</head>

<body>
    <form action="{{ route('item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{ $item->name }}" required>
        </div>
        <div>
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit">Update</button>
    </form>

</body>

</html>
