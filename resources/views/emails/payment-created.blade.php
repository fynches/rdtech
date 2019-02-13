<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<p>
    Hi {{ $payment->firstName }}, We wanted to let you know that your gift has been successfully processed.
</p>
<p>
    Order Summary:<br/>
    Date: {{ date('m/d/Y') }} <br/>
    Order Number: {{ $payment->id }} <br/>
    @foreach($payment->purchases as $purchase)
        Gift Details: {{ $purchase->gift->title }} ${{ number_format($purchase->amount, 2) }}<br/>
    @endforeach
</p>

</body>

</html>