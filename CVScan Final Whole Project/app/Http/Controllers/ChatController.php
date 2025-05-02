<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $user = Auth::user();
        $message = $request->input('message');

        if (empty($message)) {
            return response()->json(['error' => 'Message cannot be empty.'], 400);
        }

        \Log::info('User Message: ' . $message);

        // Pozivamo DeepSeek API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('DEEPSEEK_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.deepseek.com/v1/chat/completions', [
            'model' => 'deepseek-chat',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $message
                ]
            ],
            'temperature' => 0.7,
            'top_p' => 1,
            'max_tokens' => 500,
        ]);

        \Log::info('DeepSeek Response: ' . json_encode($response->json()));

        $responseArray = $response->json();

        if (isset($responseArray['choices'][0]['message']['content'])) {
            $reply = $responseArray['choices'][0]['message']['content'];

            return response()->json([
                'user_message' => $message,
                'bot_reply' => $reply
            ]);
        } else {
            return response()->json(['error' => 'Failed to process the request.'], 500);
        }
    }
}
