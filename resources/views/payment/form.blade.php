<!DOCTYPE html>
<html>

<head>
    <title>Make Payment</title>
</head>

<body>
    <h2>Enter Payment Details</h2>

    @if($errors->any())
        <div style="color: red;">
            <ul>@foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
        </div>
    @endif

    <form action="{{ route('payment.process') }}" method="POST">
        @csrf
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Amount (INR):</label><br>
        <input type="number" name="amount" min="1" required><br><br>

        <button type="submit">Pay with PayU</button>
    </form>
</body>

</html>