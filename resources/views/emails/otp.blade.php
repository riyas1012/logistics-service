<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <div id="en_text" class="ltr">
        <p>Dear <span id="user_name">{{ $details['name'] }}</span>,</p>
        <p>Your OTP code is {{ $details['otp_code'] }}</p><br><br>
        <p>Kind regards,<br>
            Logistics Service team<br>
            Supreme Committee for Delivery & Legacy</p>
    </div>

</body>

</html>
