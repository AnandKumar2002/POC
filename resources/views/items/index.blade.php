<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Items List</title>
    <style>
        .item-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .item-box {
            width: 200px;
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
            border-radius: 8px;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        .item-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
        }

        .item-name {
            margin-top: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <a href="{{ route('item.create') }}">Create</a>
    <h2>Items List</h2>

    <div class="item-container">
        @foreach ($items as $item)
            <div class="item-box">
                @if ($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="item-image">
                @else
                    <img src="{{ asset('images/default.png') }}" alt="Default Image" class="item-image">
                @endif
                <div class="item-name">{{ $item->name }}</div>
            </div>
        @endforeach
    </div>

</body>
</html>