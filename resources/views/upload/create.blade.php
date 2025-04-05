<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload Video</title>
</head>
<body>
    <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Upload Video: </label>
            <input type="file" name="video" accept="video/*" />
        </div>
        <button type="submit">Upload</button>
    </form>
</body>
</html>
