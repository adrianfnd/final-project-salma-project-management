<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use App\Models\User;

class AuthController extends Controller
{
    public function redirect()
    {
        return redirect('/staff/dashboard_project');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password wajib diisi',
        ]);
    
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user()->load('role');
    
            if ($user->role->role_name == 'Superadmin') {
                return redirect()->route('staff.index');
            } elseif ($user->role->role_name == 'Staff') {
                return redirect()->route('dashboard_project');
            } elseif ($user->role->role_name == 'Technician') {
                dd($user->role->role_name);
                return redirect()->route('dashboard_project');
            }
        }
    
        return back()->withErrors(['credentials' => 'Password atau Username yang anda masukkan salah']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}