<!DOCTYPE html>
<html>

<head>
    <title>Redirecting to PayU</title>
</head>

<body onload="document.forms['payuForm'].submit()">
    <h3>Please wait while we redirect you to PayU...</h3>
    <form action="{{ $action }}" method="post" name="payuForm">
        @foreach($data as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <input type="hidden" name="hash" value="{{ $hash }}">
    </form>
</body>

</html>