<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            $user = Auth::user();

            $request->session()->put('user_role', $user->role);
    Log::info('User logged in', ['id' => $user->id, 'role' => $user->role]);
    
    if ($user->role === 'admin') {
        return redirect('/admin/dashboard');
    } elseif ($user->role === 'rh') {
        return redirect('/rh/dashboard');
    } elseif ($user->role === 'agent') {
        return redirect('/agent/dashboard');
    } elseif ($user->role === 'directeur') {
        return redirect('/directeur/dashboard');
    } elseif ($user->role === 'dpaf') {
        return redirect('/dpaf/dashboard');
    }
    
        }
    
        return back()->withErrors([
            'email' => 'Identifiants invalides.',
        ]);
    }
    
    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
