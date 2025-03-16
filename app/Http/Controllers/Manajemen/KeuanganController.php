<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    //

    public function index()
    {
        $keuangans = Keuangan::all();
        return view('manajemen/keuangan')->with('keuangans', $keuangans);
    }

    public function update(Request $req)
    {
        Request()->validate([
            'jumlah'          =>  ['required', 'Integer', 'gt:0'],
            'tanggal'            =>  'required',
        ]);
        $newDate = Carbon::createFromFormat('m/d/Y', $req->tanggal)
            ->format('Y-m-d');
        DB::beginTransaction();
        try {
            //code...
            $keuangan = Keuangan::create([
                'jumlah'        =>  $req->jumlah,
                'tanggal'       =>  $newDate
            ]);
            DB::commit();
        } catch (\Exception $th) {
            //throw $th;
            DB::rollback();
            return back()->with('error', 'Data gagal di update');
        }
        return back()->with('success', 'Pemasukan berhasil ditambahkan!');
    }
}
