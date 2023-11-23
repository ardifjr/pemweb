<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Alert;
class SessionController extends Controller
{
    function index(){
        return view("services");
    }
    function login(Request $request)
    {
        Session::flash('username', $request->username);
        $request->validate([
            'username'=>'required',
            'password'=>'required'
        ],[
            'username.required'=>'Username Wajib Diisi',
            'password.required'=>'Password Wajib Diisi'
        ]);

        $infologin= [
            'username'=> $request->username,
            'password'=> $request->password
        ];

        if (Auth::attempt($infologin)) {
            Session::flash('username', $request->username);
            if (Auth::user()->role === 'admin') {
                Alert::success('Berhasil', 'Anda Berhasil Login');
                return redirect('adminhome');
            } elseif (Auth::user()->role === 'kasir') {
                Alert::success('Berhasil', 'Anda Berhasil Login');
                return redirect('home');
            }
        } else {
            Alert::warning('Gagal', 'Data yang Anda masukan salah');
            return redirect('sesi');
        }
    }
    function logout()
    {
    Auth::logout(); // Logout pengguna
    Alert::success('Berhasil', 'Anda Berhasil Logout');
    return redirect(''); // Redirect ke halaman login atau halaman lain yang sesuai
    }
}
