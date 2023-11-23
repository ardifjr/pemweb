<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Alert;
class AuthController extends Controller
{
    public function index()
    {
        $pegawais = user::all();
        return view('pegawai.index', compact('pegawais'));
    }

    public function showLoginForm()
    {
        return view('service');
    }

    public function showRegistrationForm()
    {
        return view('daftar');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'role' => 'required|in:kasir,admin',
            'username' => 'required|string|unique:users|max:255',
            'password' => 'required|string|min:1|confirmed',
        ]);

        $user = new User([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'role' => $request->role,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $user->save();
        Alert::success('Berhasil', 'Data berhasil ditambahkan');
        return redirect()->route('pegawai.index')->with('success', 'Pendaftaran berhasil, silakan login.');
    }
    public function login(Request $request)
{
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        Alert::success('Berhasil', 'Anda Berhasil Daftar');
        return redirect('home.index');
    } else {
        Alert::warning('Gagal', 'Anda Gagal Mendaftar');
        return redirect('service')->with('error', 'Login gagal, periksa kembali username dan password Anda.');
    }
}
public function destroy($id_user)
{
    $pegawai = User::find($id_user);

    if (!$pegawai) {
        Alert::warning('Gagal', 'Data tidak ditemukan');
        return redirect()->route('pegawai.index');
    }

    $pegawai->delete();
    Alert::success('berhasil', 'Data berhasil dihapus');
    return redirect()->route('pegawai.index');
}


public function edit($id_user)
    {
        $pegawai = User::find($id_user);
    
        if (!$pegawai) {
            return redirect()->route('pegawai.index')->with('error', 'Pegawai tidak ditemukan.');
        }
    
        return view('pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $id_user)
{
    $pegawai = User::find($id_user);

    if (!$pegawai) {
        return redirect()->route('pegawai.index')->with('error', 'Pegawai tidak ditemukan.');
    }

    $request->validate([
        'nama' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'role' => 'required',
            'username' => 'required',
            'password' => 'required',
    ]);

    $pegawai->nama = $request->input('nama');
    $pegawai->alamat = $request->input('alamat');
    $pegawai->email = $request->input('email');
    $pegawai->role = $request->input('role');
    $pegawai->username = $request->input('username');
    $pegawai->password = Hash::make($request->password);
    $pegawai->save();
    Alert::success('berhasil', 'Data berhasil diperbarui');
    return redirect()->route('pegawai.index');
}
}
