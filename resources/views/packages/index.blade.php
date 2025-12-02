<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Travel Form</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 p-6">

    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-4">Travel Details</h2>

        <form action="{{ url('/ai/generate-itinerary') }}" method="POST" class="space-y-4">
            @csrf

            <!-- From -->
            <div>
                <label class="block font-medium mb-1">From</label>
                <input type="text" name="from" placeholder="Starting location"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <!-- To -->
            <div>
                <label class="block font-medium mb-1">To</label>
                <input type="text" name="to" placeholder="Destination"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <!-- Duration -->
            <div>
                <label class="block font-medium mb-1">Duration </label>
                <input type="number" name="duration" placeholder="e.g., 3"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring focus:ring-blue-300">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                Submit
            </button>
        </form>
    </div>

</body>

</html>
