<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalPasienController extends Controller
{
    //

    public function index()
    {
        $pasien = null;
        $today = Carbon::today('Asia/Jakarta');
        $jadwal = Jadwal::all()->sortByDesc('tgl_agenda');
        return view('manajemen/jadwal-pasien', compact('jadwal', 'pasien'));
    }

    public function search(Request $req)
    {
        $today = Carbon::today('Asia/Jakarta');
        $pasien = Pasien::find($req->id);
        $jadwal = $pasien->jadwal->sortByDesc('tgl_agenda')->all();
        return view('manajemen/jadwal-pasien', compact('jadwal', 'pasien'));
    }
}
