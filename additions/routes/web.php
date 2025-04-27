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

