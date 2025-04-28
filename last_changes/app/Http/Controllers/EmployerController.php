<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class EmployerController extends Controller
{
    public function showEmployees()
    {
        $employees = User::where('status', 'employee')->get();

        return view('users', compact('employees'));
    }
}
