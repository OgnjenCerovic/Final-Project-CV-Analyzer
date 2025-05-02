<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $apiKey = env('DEEPSEEK_API_KEY');

    $url = 'https://api.deepseek.com/v1/chat/completions';

    $data = [
        'model' => 'deepseek-chat',
        'messages' => [
            [
                'role' => 'user',
                'content' => 'Hi do you know what is base64 encoding?'
            ]
        ],
        'temperature' => 0.7,
        'max_tokens' => 300,
    ];

    $headers = [
        "Authorization: Bearer $apiKey",
        "Content-Type: application/json",
    ];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode == 200) {
        $responseArray = json_decode($response, true);
        if (isset($responseArray['choices'][0]['message']['content'])) {
            echo "Bot Reply: " . $responseArray['choices'][0]['message']['content'] . "\n";
        } else {
            echo "No reply found.\n";
        }
    } else {
        echo "Request failed with status code $httpcode\n";
        echo $response;
    }
})->name('test');

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/galery', function () {
    return view('galery');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return 'Welcome to Dashboard!';
});

Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth', 'employee'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile/uploadResume', [ProfileController::class, 'uploadResume'])->name('profile.uploadResume');
    Route::delete('/profile/deleteResume', [ProfileController::class, 'deleteResume'])->name('profile.deleteResume');
    Route::post('/profile/analyzeResume', [ProfileController::class, 'analyzeResume'])->name('profile.analyzeResume');
    Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat', function () {return view('chat');})->name('chat');
    Route::get('/suggest', [JobController::class, 'suggestJobs'])->name('suggest');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/employer/users', [EmployerController::class, 'showEmployees'])->name('employer.users');
});

