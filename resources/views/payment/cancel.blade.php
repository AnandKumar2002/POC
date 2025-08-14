<!DOCTYPE html>
<html>

<head>
    <title>Payment Failed</title>
</head>

<body>
    <h2>❌ Payment Failed or Cancelled</h2>
    <p>Status: {{ $data['status'] ?? 'Cancelled' }}</p>
</body>

</html>