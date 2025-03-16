<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use App\Models\Rekam_medis;
use App\Models\Relasi_obat;
use App\Models\Riwayat_Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObatController extends Controller
{
    //

    public function index()
    {
        $obats  = Obat::paginate(10);
        return view('manajemen/obat')->with('obats', $obats);
    }

    public function update(Request $req)
    {
        Request()->validate([
            'nama'          =>  'required',
            'pabrikan'      =>  'required',
            'golongan'      =>  'required',
            'stok'          =>  ['required', 'Integer'],
        ]);
        DB::beginTransaction();
        try {
            //code...
            $obat = Obat::find($req->id);
            if ($req->tipe == "Pengurangan") {
                if ($req->stok > $obat->stok) {
                    DB::rollback();
                    return back()->with('transactionerror', 'Gagal mengurangi stok obat. Sisa stok obat tidak lebih banyak dari ' . $req->stok);
                }
                $obat->update([
                    'stok'          => $obat->stok - $req->stok
                ]);
            } else {
                $obat->update([
                    'stok'          => $obat->stok + $req->stok
                ]);
            }
            $obat->update(
                [
                    'nama'          => $req->nama,
                    'pabrikan'      => $req->pabrikan,
                    'golongan'      => $req->golongan,
                ]
            );
            $obat->riwayat_obat()->create([
                'tipe'      =>  $req->tipe,
                'jumlah'    =>  $req->stok,
                'stok'      =>  $obat->stok,
            ]);
            DB::commit();
        } catch (\Exception $th) {
            //throw $th;
            return back()->with('errors', $th);
            DB::rollBack();
        }
        return back()->with('success', 'Data obat berhasil diperbaharui!');
    }

    public function store(Request $req)
    {
        Request()->validate([
            'nama'          =>  'required',
            'pabrikan'      =>  'required',
            'golongan'      =>  'required',
            'stok'          =>  ['required', 'Integer'],
        ]);

        DB::beginTransaction();
        try {
            //code...
            if (Obat::where(
                [
                    'nama'          => $req->nama,
                    'pabrikan'      => $req->pabrikan,
                    'golongan'      => $req->golongan,
                ]
            )->exists()) {
                return back()->with('exist', 'Data obat sudah ada sebelumnya!');
            }
            $obat = Obat::create([
                'nama'          =>  $req->nama,
                'pabrikan'      =>  $req->pabrikan,
                'golongan'      =>  $req->golongan,
                'stok'          =>  $req->stok,
            ]);
            $tipe = "Tambah obat baru";
            $obat->riwayat_obat()->create([
                'tipe'      =>  $tipe,
                'jumlah'    =>  $req->stok,
                'stok'      =>  $req->stok,
            ]);
            DB::commit();
        } catch (\Exception $th) {
            throw $th;
            return back()->with('errors', $th);
            DB::rollBack();
        }
        return back()->with('success', 'Obat berhasil ditambahkan!');
    }

    public function index_riwayat(Request $req)
    {
        $obat = Obat::find($req->id);
        $riwayat = $obat->riwayat_obat->all();
        return view('manajemen.obat.riwayat-update')->with('riwayat', $riwayat);
    }
}
