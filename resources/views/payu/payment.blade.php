<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay with PayU</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-xl p-8 w-full max-w-md">
        <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Pay with PayU</h2>

        <form action="{{ route('payu.process') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-600 mb-1">Amount</label>
                <input type="number" name="amount"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter Amount" required>
            </div>

            <div>
                <label class="block text-gray-600 mb-1">Full Name</label>
                <input type="text" name="firstname"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter Name" required>
            </div>

            <div>
                <label class="block text-gray-600 mb-1">Email</label>
                <input type="email" name="email"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter Email" required>
            </div>

            <div>
                <label class="block text-gray-600 mb-1">Phone</label>
                <input type="text" name="phone"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Enter Phone Number" required>
            </div>

            <div>
                <label class="block text-gray-600 mb-1">Product Info</label>
                <input type="text" name="productinfo" value="Test Product"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white font-medium py-2 rounded hover:bg-blue-700 transition">
                Proceed to Pay
            </button>
        </form>
    </div>

</body>

</html>