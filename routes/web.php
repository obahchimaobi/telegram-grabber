<?php

use Illuminate\Support\Facades\Route;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Http\Controllers\TelegramController;

Route::get('/', function () {
    return view('home');
});

Route::get('/telegram/auth', [TelegramController::class, 'auth'])->name('auth.telegram');

Route::get('/logout', function () {
    Auth::logout();
});

Route::get('/send-message', function () {
    $chatId = '1550130260'; // Replace with your chat ID
    $message = 'Hello, this is a message from Laravel!';

    Telegram::sendMessage([
        'chat_id' => $chatId,
        'text' => $message,
    ]);

    return 'Message sent to Telegram!';
});