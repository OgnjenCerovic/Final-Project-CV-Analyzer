<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;

class JobController extends Controller
{
    public function suggestJobs()
    {
        $user = Auth::user();
        $resumePath = 'public/resumes/' . $user->resume;

        if (!Storage::exists($resumePath)) {
            return response()->json(['error' => 'Resume not found'], 404);
        }

        $pdfContent = Storage::get($resumePath);

        $parser = new Parser();
        $pdf = $parser->parseContent($pdfContent);
        $resumeText = $pdf->getText();

        $resumeText = strtolower($resumeText);

        $resumeText = preg_replace('/[\w\.-]+@[\w\.-]+\.\w+/', '', $resumeText);
        $resumeText = preg_replace('/https?:\/\/\S+/', '', $resumeText);
        $resumeText = preg_replace('/\b\d+\b/', '', $resumeText);


        $resumeWords = preg_split('/\s+/', trim($resumeText));

        $stopwords = [
            'linkedin', 'github', 'website', 'email', 'contact', 'phone',
            'address', 'name', 'summary', 'skills', 'experience', 'education',
            'projects', 'profile', 'certifications', 'references'
        ];

        $resumeWords = array_filter(array_map('trim', $resumeWords), function ($word) use ($stopwords) {
            return !in_array($word, $stopwords) && strlen($word) > 2;
        });

        $keywords = implode(' ', array_slice($resumeWords, 0, 5)); // Get first 5 relevant words

        if (empty(trim($keywords))) {
            return response()->json(['error' => 'No valid keywords found in resume'], 400);
        }

        if (empty(trim($keywords))) {
            return response()->json(['error' => 'No valid keywords found in resume'], 400);
        }

        $response = Http::withHeaders([
            'X-RapidAPI-Key' => env('JSEARCH_API_KEY'),
            'X-RapidAPI-Host' => 'jsearch.p.rapidapi.com',
        ])->get('https://jsearch.p.rapidapi.com/search', [
            'query' => $keywords,
            'page' => 1,
            'num_pages' => 1,
            'country' => 'us',
            'language' => 'en'
        ]);

        $jobs = $response->json()['data'];

        return view('jobs', compact('jobs'));
    }
}
