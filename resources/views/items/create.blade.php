<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Items</title>
</head>
<body>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Items</title>
</head>
<body>
    <form action="{{ route('item.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" id="name" />
        <input type="file" name="image" id="image" />
        <input type="submit" value="Submit">
    </form>
</body>
</html>
</body>
</html>