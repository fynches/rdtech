<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<p style = 'text-align : center'>
    Hi {{ $page->child->user->first_name }}, We're excited to let you know that your gift page is live and ready for friends and family!
    Don't forget to share your page with friends and family so they can give a gift!
    To easily share your page, use the share features on your gift page.
</p>
<div style = 'text-align: center;'>
    <!--[if mso]>
    <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="{{ url('/gift-page/' . $page->slug) }}" style="height:40px;v-text-anchor:middle;width:200px;" arcsize="10%" strokecolor="#1e3650" fill="t">
        <v:fill type="tile" src="https://i.imgur.com/0xPEf.gif" color="#556270" />
        <w:anchorlock/>
        <center style="color:#ffffff;font-family:sans-serif;font-size:13px;font-weight:bold;">I Want To Share My Page</center>
    </v:roundrect>
    <![endif]-->
    <a href="{{ url('/gift-page/' . $page->slug) }}" style="background-color:#556270;background-image:url(https://i.imgur.com/0xPEf.gif);border:1px solid #1e3650;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:200px;-webkit-text-size-adjust:none;mso-hide:all;">
        I Want To Share My Page
    </a>
</div>

</body>

</html>