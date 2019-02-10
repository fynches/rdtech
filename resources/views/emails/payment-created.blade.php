<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<p>
    Thank you for making a purchase at Fynches
</p>
<p>
    You can view your receipt here: <a href = '{{ $payment->receipt_url }}'>{{ $payment->receipt_url }}</a>
</p>

</body>

</html>