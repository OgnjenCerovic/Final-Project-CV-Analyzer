<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Orhanerday\OpenAi\OpenAi;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function analyzeResume(Request $request)
    {
        $user = Auth::user();

        if (!$user->resume) {
            return redirect()->route('profile')->with('error', 'No resume uploaded.');
        }

        $resumeContent = Storage::get('public/resumes/' . $user->resume);

        $resumeContent = json_encode($resumeContent, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        $resumeContent = trim($resumeContent, '"');

        $prompt = "Analyze this resume and provide feedback on the following aspects: structure, skills, achievements, formatting, and suggestions for improvement.\n\n$resumeContent";
        $prompt = "Analyze the following resume and provide detailed feedback on the following aspects: structure, skills, achievements, formatting, and suggestions for improvement.\n\n$resumeContent";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('GOOSEAI_API_KEY'),
            'Content-Type'  => 'application/json',
        ])->post('https://api.goose.ai/v1/engines/gpt-neo-2-7b/completions', [
            'model'   => 'gpt-neo-2-7b',
            'prompt'  => $prompt,
            'max_tokens' => 500,
            'temperature' => 0.7,
            'top_p' => 1.0,
        ]);

        $responseArray = $response->json();

        if (isset($responseArray['choices'][0]['text'])) {
            $analysis = $responseArray['choices'][0]['text'];

            session()->flash('resume_analysis', $analysis);

            return redirect()->route('profile')->with('success', 'Resume analysis complete.');
        } else {
            return redirect()->route('profile')->with('error', 'Failed to analyze resume.');
        }
    }

    public function show()
    {
        return view('profile');
    }

    public function uploadResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:10240',
        ]);

        $user = Auth::user();

        if ($user->resume) {
            Storage::delete('public/resumes/' . $user->resume);
        }

        $fileName = time() . '.' . $request->file('resume')->extension();
        $path = $request->file('resume')->storeAs('public/resumes', $fileName);

        $user->resume = $fileName;
        $user->save();

        return redirect()->route('profile')->with('success', 'Resume uploaded successfully.');
    }

    public function deleteResume()
    {
        $user = Auth::user();

        if ($user->resume) {
            Storage::delete('public/resumes/' . $user->resume);
            $user->resume = null;
            $user->save();
        }

        return redirect()->route('profile')->with('success', 'Resume deleted successfully.');
    }
}
