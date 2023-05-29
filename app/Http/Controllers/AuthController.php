<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Akun;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

    class AuthController extends Controller
    {
    //masuk ke halaman login 
    public function LoginPage()
    {
        return view('auth.signin');
    }

    public function login(Request $request)
    {
        //digunakan untuk memvalidasi
        $request->validate([
            // Memvalidasi bahwa field 'username' harus diisi dan harus berupa email.
            'username' => ['required', 'email'],
            // Memvalidasi bahwa field 'password' harus diisi.
            'password' => ['required'],
        ]);
        //mencari data username dari model tabel akun
        $akun = Akun::where('username', $request->username)->first();
        //jika akun tidak ditemukan maka akan kembali dengan error akun tidak terdaftar
        if (!$akun) {
            return back()
                ->withErrors([
                    'username' => 'Akun tidak terdaftar!',
                ])
                ->withInput();
        }
        //meminta request password pada tabel akun dengan md5, 
        //jika error maka akan kembali dengan pesan error
        if (md5($request->password) !== $akun->password) {
            return back()
                ->withErrors([
                    'username' => 'Email atau Password yang diinputkan salah!',
                ])
                ->withInput();
        }
        //jika role akun bukan admin maka akan kembali ke login degan error
        if ($akun->role != 'admin') {
            return back()
                ->withErrors([
                    'username' => 'Anda tidak memiliki hak akses untuk login!',
                ])
                ->withInput();
        }
        //auth login jika berhasil dan akan masuk ke halaman dashboard dengan pesan
        Auth::login($akun);
        Session::flash('berhasilLogin', 'Login Berhasil!');
        return redirect()->route('dashboard');
    }
    
    //fungsi logout, yang akan mengembalikan ke landingpage
    function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        Session::flash('logout', 'Logout Berhasil!');
        return redirect('/login');
    }
}
