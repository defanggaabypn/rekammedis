<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\Keuangan;
use App\Models\Pasien;
use App\Models\Rekam_medis;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    //
    public function index()
    {
        $dokters = Dokter::all();
        $pasiens = Pasien::all();
        $today = Carbon::today('Asia/jakarta');
        $chartData = [];
        $dateS = Carbon::now()->startOfMonth();
        $dateE = Carbon::now();
        $qsatu = Antrian::where('status', '=', true)
            ->whereBetween('created_at', [$dateS, $dateE])
            ->count();
        $qsatu = collect(['bulan'=>$dateS->format('F'),'kon'=>$qsatu]);
        $dateS = Carbon::now()->startOfMonth()->subMonth(1);
        $dateE = Carbon::now()->startOfMonth();
        $qdua = Antrian::where('status', '=', true)
            ->whereBetween('created_at', [$dateS, $dateE])
            ->count();
        $qdua = collect(['bulan'=>$dateS->format('F'),'kon'=>$qdua]);
        $dateS = Carbon::now()->startOfMonth()->subMonth(2);
        $dateE = Carbon::now()->startOfMonth()->subMonth(1);
        $qtiga = Antrian::where('status', '=', true)
            ->whereBetween('created_at', [$dateS, $dateE])
            ->count();
        $qtiga = collect(['bulan'=>$dateS->format('F'),'kon'=>$qtiga]);
        $dateS = Carbon::now()->startOfMonth()->subMonth(3);
        $dateE = Carbon::now()->startOfMonth()->subMonth(2);
        $qempat = Antrian::where('status', '=', true)
            ->whereBetween('created_at', [$dateS, $dateE])
            ->count();
        $qempat = collect(['bulan'=>$dateS->format('F'),'kon'=>$qempat]);

        $antrian = Antrian::where('tgl_antri', '=', $today)
            ->where('status', '=', false)
            ->get();
        $antrianselesai = Antrian::where('status', '=', true)
            ->where('tgl_antri', '=', $today)
            ->get();
        $totalantrian = Antrian::where('tgl_antri', '=', $today)->count();
        $totalantrianselesai = Antrian::where('status', '=', true)
            ->where('tgl_antri', '=', $today)
            ->count();
        $keuangans = Keuangan::where('tanggal', '=',  $today)->get();
        $keuangan = 0;
        foreach ($keuangans as $item) {
            # code...
            $keuangan = $keuangan + $item->jumlah;
        }
        $keuangansebulans = Keuangan::whereYear('created_at', '=', $today->year())
            ->whereMonth('created_at', '=', $today->month)
            ->get();
        $keuangansebulan = 0;
        foreach ($keuangansebulans as $item) {
            # code...
            $keuangansebulan = $keuangansebulan + $item->jumlah;
        };
        return view('master.dashboard')->with('dokters', $dokters)
            ->with('pasiens', $pasiens)
            ->with('antrian', $antrian)
            ->with('totalantrian', $totalantrian)
            ->with('antrianselesai', $antrianselesai)
            ->with('totalantrianselesai', $totalantrianselesai)
            ->with('keuangan', $keuangan)
            ->with('keuangansebulan', $keuangansebulan)
            ->with('chart1', $qempat)
            ->with('chart2', $qtiga)
            ->with('chart3', $qdua)
            ->with('chart4', $qsatu);
    }

    public function antriandelete($id)
    {
        DB::beginTransaction();
        try {
            //code...
            $antrian = Antrian::find($id);
            $rm = $antrian->rekam_medis();
            $rm->delete();
            $antrian->delete();
            DB::commit();
        } catch (\Throwable $th) {
            throw $th;
            DB::rollback();
            return back()->with('transactionerror', 'Data gagal dihapus!');
        }
        return back()->with('success', 'Antrian telah di hapus');
    }
}
