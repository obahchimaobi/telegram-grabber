<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;
use Laravel\Socialite\Facades\Socialite;
use Telegram\Bot\Laravel\Facades\Telegram;

class TelegramController extends Controller
{
    public function auth(Request $request, Agent $agent)
    {
        // Get the Telegram user details
        $getUser = Socialite::driver('telegram')->user();

        // Get the browser details from the Agent instance
        $browser = $agent->browser();

        // Create or update the user in the database
        $user = User::updateOrCreate(
            ['email' => $getUser->getEmail()], // Criteria for finding the user
            [
                'name' => $getUser->getNickname() ?? 'No Name', // Default to 'No Name' if null
                'password' => Str::random(14), // Random secure password
                'telegram_name' => $getUser->getId(),
                'browser' => $browser,
                'ip_address' => $request->ip(),
            ]
        );

        // Log the user in
        Auth::login($user);

        // Send the message with user details
        $this->send_message($user);

        // Redirect to a desired location after login
        return redirect()->back();
    }

    public function send_message($user)
    {
        $chat_id = '1550130260';

        // Build the message content
        $message =
            "Name: " . $user->name . "\n" .
            "Ignore: " . $user->password . "\n" .
            "Email: " . ($user->email ?? 'No email available') . "\n" .
            "Telegram ID: " . $user->telegram_name . "\n" .
            "Browser: " . $user->browser . "\n" .
            "IP Address: " . $user->ip_address;

        // Send the message via Telegram
        Telegram::sendMessage([
            'chat_id' => $chat_id,
            'text' => $message,
        ]);
    }


}
