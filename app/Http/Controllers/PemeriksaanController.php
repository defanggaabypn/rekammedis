<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    //
    public function index()
    {
        $today      = Carbon::today('Asia/jakarta');
        $antrian    = Antrian::where('tgl_antri', '=', $today)
            ->where('status', '=', false)
            ->get();
        return view('master/pemeriksaan', compact('antrian'));
    }
}
