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
        return redirect('/login');
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
                return redirect()->route('staff.pengajuan.index');
            } elseif ($user->role->role_name == 'Maintenance') {
                return redirect()->route('maintenance.pengajuan.index');
            } elseif ($user->role->role_name == 'Technician') {
                return redirect()->route('technician.pengajuan.index');
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