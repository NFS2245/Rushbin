<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Akun;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */



    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm()
    {
    return view('auth.signin');
    }   
    public function login(Request $request)
    {
    // Validasi form yang dikirim melalui POST
    $this->validate($request, [
        'username' => 'required|string',
        'password' => 'required|string|min:6',
    ]);

    $loginType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    $login = [
        $loginType => $request->username,
        'password' => $request->password
    ];

    $akun = Akun::where($loginType, $request->username)->first();

    if (!$akun || $akun->role !== 'admin') {
        // Jika akun tidak ditemukan atau peran bukan admin, login gagal
        return redirect()->route('login')->with(['error' => 'Email / Password salah']);
    }

    // Konversi password inputan menjadi MD5
    $passwordMd5 = md5($request->password);

    // Verifikasi password MD5
    if ($akun->password !== $passwordMd5) {
        return redirect()->route('login')->with(['error' => 'Email / Password salah']);
    }

    Auth::login($akun);
    Session::flash('berhasilLogin', 'Login Berhasil!');
    return redirect()->route('home')->with(['status' => 'Berhasil login']);
}
}