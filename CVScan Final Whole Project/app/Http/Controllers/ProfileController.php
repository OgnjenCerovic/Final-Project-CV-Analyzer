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

        $resumePath = 'public/resumes/' . $user->resume;

        if (!Storage::exists($resumePath)) {
            return redirect()->route('profile')->with('error', 'Resume file not found.');
        }

        // Get file extension
        $extension = strtolower(pathinfo($user->resume, PATHINFO_EXTENSION));

        try {
            if ($extension === 'pdf') {
                // Handle PDF files
                $parser = new \Smalot\PdfParser\Parser();
                $pdf = $parser->parseFile(Storage::path($resumePath));
                $resumeContent = $pdf->getText();
            } elseif (in_array($extension, ['doc', 'docx'])) {
                // Handle Word documents
                $phpWord = \PhpOffice\PhpWord\IOFactory::load(Storage::path($resumePath));
                $resumeContent = '';
                foreach ($phpWord->getSections() as $section) {
                    foreach ($section->getElements() as $element) {
                        if ($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
                            foreach ($element->getElements() as $text) {
                                if ($text instanceof \PhpOffice\PhpWord\Element\Text) {
                                    $resumeContent .= $text->getText();
                                }
                            }
                        }
                    }
                }
            } else {
                // Handle plain text files
                $resumeContent = Storage::get($resumePath);
                // Ensure UTF-8 encoding
                $resumeContent = mb_convert_encoding($resumeContent, 'UTF-8', 'UTF-8');
            }

            // Clean up the content
            $resumeContent = trim($resumeContent);
            $resumeContent = preg_replace('/\s+/', ' ', $resumeContent); // Replace multiple spaces

            if (empty($resumeContent)) {
                return redirect()->route('profile')->with('error', 'Resume file is empty or could not be read.');
            }

            $systemPrompt = "You are an expert career advisor. Analyze the given resume and provide detailed feedback..."; // your existing prompt

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('DEEPSEEK_API_KEY'),
                'Content-Type' => 'application/json',
            ])->timeout(120)->post('https://api.deepseek.com/v1/chat/completions', [
                'model' => 'deepseek-chat',
                'messages' => [
                    ['role' => 'system', 'content' => $systemPrompt],
                    ['role' => 'user', 'content' => $resumeContent],
                ],
                'temperature' => 0.7,
                'max_tokens' => 2000,
            ]);

            if ($response->failed()) {
                throw new \Exception('API request failed: ' . $response->body());
            }

            $responseData = $response->json();

            if (!isset($responseData['choices'][0]['message']['content'])) {
                throw new \Exception('Invalid API response structure');
            }

            return redirect()->route('profile')
                ->with('success', 'Resume analysis complete.')
                ->with('resume_analysis', $responseData['choices'][0]['message']['content']);

        } catch (\Exception $e) {
            return redirect()->route('profile')
                ->with('error', 'Failed to analyze resume: ' . $e->getMessage());
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
            Storage::delete('/storage/app/public/resumes/' . $user->resume);
            $user->resume = null;
            $user->save();
        }

        return redirect()->route('profile')->with('success', 'Resume deleted successfully.');
    }
}
