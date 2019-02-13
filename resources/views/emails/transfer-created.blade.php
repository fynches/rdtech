<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<p style = 'text-align : center'>
    Hi {{ $transfer->account->user->first_name }},
    The funds that you requested in the amount of ${{ number_format($transfer->amount / 100, 2) }} on {{ date('m/d/Y') }}
    have been successfully redeemed! Please allow 5 business days for the funds to be deposited in your account.
</p>
<div style = 'text-align: center;'>
    <!--[if mso]>
    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ url('/gift-dashboard') }}" style="height:40px;v-text-anchor:middle;width:200px;" arcsize="10%" strokecolor="#1e3650" fill="t">
        <v:fill type="tile" src="https://i.imgur.com/0xPEf.gif" color="#556270" />
        <w:anchorlock/>
        <center style="color:#ffffff;font-family:sans-serif;font-size:13px;font-weight:bold;">Take Me To My Account</center>
    </v:roundrect>
    <![endif]-->
    <a href="{{ url('/gift->dashboard') }}" style="background-color:#556270;background-image:url(https://i.imgur.com/0xPEf.gif);border:1px solid #1e3650;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;mso-hide:all;">
        Take Me To My Account
    </a>
</div>

</body>

</html>