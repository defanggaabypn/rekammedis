<?php

namespace App\Http\Controllers\Manajemen;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rekam_medis;
use App\Models\Dokter;
use Illuminate\Support\Facades\DB;

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
        $user = auth()->user();
        
        // Menghitung jumlah pasien terselesaikan
        $pasienCount = 0;
        
        if ($user->role == 'dokter') {
            // Jika user adalah dokter, cari dokter di tabel dokters berdasarkan nama
            $dokter = Dokter::where('nama', $user->nama)->first();
            
            if ($dokter) {
                // Menghitung rekam medis dengan status=1 (selesai) untuk dokter ini
                $pasienCount = Rekam_medis::where('id_dokter', $dokter->id)
                    ->where('status', 1)
                    ->count();
            }
        } elseif ($user->role == 'superadmin' || $user->role == 'admin') {
            // Untuk superadmin, tampilkan total pasien terselesaikan
            $pasienCount = Rekam_medis::where('status', 1)->count();
        }
        
        return view('manajemen.akun.profile', compact('user', 'pasienCount'));
    }
}