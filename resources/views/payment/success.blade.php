<!DOCTYPE html>
<html>

<head>
    <title>Payment Success</title>
</head>

<body>
    <h2>🎉 Payment Successful!</h2>
    <p>Transaction ID: {{ $data['txnid'] }}</p>
    <p>Status: {{ $data['status'] }}</p>
    <p>Amount: ₹{{ $data['amount'] }}</p>
</body>

</html>