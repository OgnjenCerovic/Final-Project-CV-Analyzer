<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Smalot\PdfParser\Parser;

class JobController extends Controller
{
    public function suggestJobs_old()
    {
        $user = Auth::user(); // Get authenticated user
        $resumePath = 'public/resumes/' . $user->resume; // Resume path

        if (!Storage::exists($resumePath)) {
            return response()->json(['error' => 'Resume not found'], 404);
        }

        // Get resume content
        $pdfContent = Storage::get($resumePath);

        // Parse PDF
        $parser = new Parser();
        $pdf = $parser->parseContent($pdfContent);
        $resumeText = $pdf->getText();

        $resumeText = strtolower($resumeText); // Convert to lowercase

// Remove emails, URLs, and numbers
        $resumeText = preg_replace('/[\w\.-]+@[\w\.-]+\.\w+/', '', $resumeText); // Remove emails
        $resumeText = preg_replace('/https?:\/\/\S+/', '', $resumeText); // Remove URLs
        $resumeText = preg_replace('/\b\d+\b/', '', $resumeText); // Remove numbers

// Remove unwanted words (common resume sections)

        $resumeWords = preg_split('/\s+/', trim($resumeText));

// Define stopwords (unwanted terms)
        $stopwords = [
            'linkedin', 'github', 'website', 'email', 'contact', 'phone',
            'address', 'name', 'summary', 'skills', 'experience', 'education',
            'projects', 'profile', 'certifications', 'references'
        ];

// Remove stopwords & empty words
        $resumeWords = array_filter(array_map('trim', $resumeWords), function ($word) use ($stopwords) {
            return !in_array($word, $stopwords) && strlen($word) > 2;
        });

        $keywords = implode(' ', array_slice($resumeWords, 0, 5)); // Get first 5 relevant words

        if (empty(trim($keywords))) {
            return response()->json(['error' => 'No valid keywords found in resume'], 400);
        }

        // Ensure query is valid
        if (empty(trim($keywords))) {
            return response()->json(['error' => 'No valid keywords found in resume'], 400);
        }


        // Call JSearch API
        $response = Http::withHeaders([
            'X-RapidAPI-Key' => env('JSEARCH_API_KEY'),
            'X-RapidAPI-Host' => 'jsearch.p.rapidapi.com',
        ])->get('https://jsearch.p.rapidapi.com/search', [
            'query' => $keywords, // Limit query to 50 characters
            'page' => 1,
            'num_pages' => 1,
            'country' => 'us', // Set to user's country (e.g., 'rs' for Serbia)
            'language' => 'en'
        ]);

        return response()->json($response->json()["data"]);
    }
    public function suggestJobs()
    {
        $user = Auth::user(); // Get authenticated user
        $resumePath = 'public/resumes/' . $user->resume; // Resume path

        if (!Storage::exists($resumePath)) {
            return response()->json(['error' => 'Resume not found'], 404);
        }

        // Get resume content
        $pdfContent = Storage::get($resumePath);

        // Parse PDF
        $parser = new Parser();
        $pdf = $parser->parseContent($pdfContent);
        $resumeText = $pdf->getText();

        $resumeText = strtolower($resumeText); // Convert to lowercase

// Remove emails, URLs, and numbers
        $resumeText = preg_replace('/[\w\.-]+@[\w\.-]+\.\w+/', '', $resumeText); // Remove emails
        $resumeText = preg_replace('/https?:\/\/\S+/', '', $resumeText); // Remove URLs
        $resumeText = preg_replace('/\b\d+\b/', '', $resumeText); // Remove numbers

// Remove unwanted words (common resume sections)

        $resumeWords = preg_split('/\s+/', trim($resumeText));

// Define stopwords (unwanted terms)
        $stopwords = [
            'linkedin', 'github', 'website', 'email', 'contact', 'phone',
            'address', 'name', 'summary', 'skills', 'experience', 'education',
            'projects', 'profile', 'certifications', 'references'
        ];

// Remove stopwords & empty words
        $resumeWords = array_filter(array_map('trim', $resumeWords), function ($word) use ($stopwords) {
            return !in_array($word, $stopwords) && strlen($word) > 2;
        });

        $keywords = implode(' ', array_slice($resumeWords, 0, 5)); // Get first 5 relevant words

        if (empty(trim($keywords))) {
            return response()->json(['error' => 'No valid keywords found in resume'], 400);
        }

        // Ensure query is valid
        if (empty(trim($keywords))) {
            return response()->json(['error' => 'No valid keywords found in resume'], 400);
        }


        // Call JSearch API
        $response = Http::withHeaders([
            'X-RapidAPI-Key' => env('JSEARCH_API_KEY'),
            'X-RapidAPI-Host' => 'jsearch.p.rapidapi.com',
        ])->get('https://jsearch.p.rapidapi.com/search', [
            'query' => $keywords, // Limit query to 50 characters
            'page' => 1,
            'num_pages' => 1,
            'country' => 'us', // Set to user's country (e.g., 'rs' for Serbia)
            'language' => 'en'
        ]);

        $jobs = $response->json()['data']; // Extract job data

        return view('jobs', compact('jobs')); // Pass job data to view
    }
}
