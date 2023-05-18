<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function LoginPage()
    {
        return view('auth.signin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $akun = Akun::where('username', $request->username)->first();

        if (!$akun) {
            return back()
                ->withErrors([
                    'username' => 'Akun tidak terdaftar!',
                ])
                ->withInput();
        }

        if ($request->password !== $akun->password) {
            return back()
                ->withErrors([
                    'username' => 'Email atau Password yang diinputkan salah!',
                ])
                ->withInput();
        }

        if ($akun->role != 'admin') {
            return back()
                ->withErrors([
                    'username' => 'Anda tidak memiliki hak akses untuk login!',
                ])
                ->withInput();
        }

        Auth::login($akun);
        Session::flash('berhasilLogin', 'Login Berhasil!');
        return redirect()->route('dashboard');
    }
    
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Session::flash('logout', 'Logout Berhasil!');
        return redirect('/login');
    }
}
