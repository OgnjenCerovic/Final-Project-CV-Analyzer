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

        if (!$user->resume) {
            return response()->json(['error' => 'No resume uploaded.'], 400);
        }

        $resumePath = 'public/resumes/' . $user->resume;

        if (!Storage::exists($resumePath)) {
            return response()->json(['error' => 'Resume file not found.'], 400);
        }

        // Read the resume content
        $resumeContent = Storage::get($resumePath);
        if (empty(trim($resumeContent))) {
            return response()->json(['error' => 'Resume file is empty.'], 400);
        }

        // Log the actual content
        \Log::info('Resume Content: ' . $resumeContent);

        $resumeContent = trim(json_encode($resumeContent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES), '"');


        $prompt = "You are an AI resume assistant. Your job is to analyze resumes and provide constructive feedback.\n\n";
        $prompt .= "Resume Content:\n====\n" . $resumeContent . "\n====\n";
        $prompt .= "User query: " . $message . "\n";
        $prompt .= "Assistant:";

        $prompt = $message;

        \Log::info('User Message: ' . $message);
        \Log::info('Generated Prompt: ' . $prompt);

        // Send request to GooseAI
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GOOSEAI_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.goose.ai/v1/engines/fairseq-13b/completions', [
            'model'   => 'fairseq-13b',
            'prompt'  => $prompt,
            'max_tokens' => 300,
            'temperature' => 0.5,
            'top_p' => 1.0,
        ]);

        \Log::info('GooseAI Response: ' . json_encode($response->json()));

        $responseArray = $response->json();

        if (isset($responseArray['choices'][0]['text'])) {
            $reply = $responseArray['choices'][0]['text'];

            return response()->json([
                'user_message' => $message,
                'bot_reply' => $reply
            ]);
        } else {
            return response()->json(['error' => 'Failed to process the request.'], 500);
        }
    }
}
