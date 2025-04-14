<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // Show profile page
    public function show()
    {
        return view('profile');
    }

    // Handle resume upload
    public function uploadResume(Request $request)
    {
        // Validate the file
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:10240', // Max 10MB
        ]);

        $user = Auth::user();

        // If user already has a resume, delete the old one
        if ($user->resume) {
            Storage::delete('public/resumes/' . $user->resume);
        }

        // Store the new resume file
        $fileName = time() . '.' . $request->file('resume')->extension();
        $path = $request->file('resume')->storeAs('public/resumes', $fileName);

        // Update user resume path in the database
        $user->resume = $fileName;
        $user->save();

        return redirect()->route('profile')->with('success', 'Resume uploaded successfully.');
    }

    // Handle resume deletion
    public function deleteResume()
    {
        $user = Auth::user();

        // If the user has a resume, delete it
        if ($user->resume) {
            Storage::delete('public/resumes/' . $user->resume);
            $user->resume = null;
            $user->save();
        }

        return redirect()->route('profile')->with('success', 'Resume deleted successfully.');
    }
}
