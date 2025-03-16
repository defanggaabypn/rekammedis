<?php

namespace App\Http\Controllers\Manajemen;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AkunController extends Controller
{
    public function gantiPassword()
    {
        return view('manajemen.akun.ganti-password');
    }

    public function updatePassword()
    {
        request()->validate([
            'old_password'      => 'required',
            'password'          => 'required|confirmed'
        ]);

        $passwordLama = auth()->user()->password;
        $inputPassword = request('old_password');

        if (Hash::check($inputPassword, $passwordLama)) {
            auth()->user()->update([
                'password' => bcrypt(request('password')),
            ]);
            return redirect()
                ->route('akun.ganti-password')
                ->with('success', 'Berhasil merubah password');
        } else {
            return redirect()
                ->route('akun.ganti-password')
                ->withErrors(['old_password' => 'Password tidak sesuai']);
        }
    }

    public function profil()
    {
        return view('manajemen.akun.profile');
    }
}