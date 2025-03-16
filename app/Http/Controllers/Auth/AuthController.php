<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            return redirect()->route('home')->with([
                'user', $user
            ]);
        }
        return view('auth.login');
    }

    public function login(Request $req)
    {
        request()->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $credentials = $req->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect()->route('home')->with('user', $user);
        }
        Session::flash('error', 'Email atau password salah');
        return redirect()->route('login');
    }

    public function logout(Request $req)
    {
        $req->session()->flush();
        Auth::logout();
        return redirect()->route('login');
    }
}
