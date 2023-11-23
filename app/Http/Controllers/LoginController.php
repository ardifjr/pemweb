<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    protected function authenticated(Request $request, $user)
{
    return view('home.index'); // Mengarahkan ke tampilan home.index
}

    public function showLoginForm()
    {
        return view('service');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/home');
        } else {
            return redirect()->back()->with('message', 'Email atau password salah.');
        }
    }
}
