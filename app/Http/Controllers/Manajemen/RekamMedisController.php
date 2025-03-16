<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Rekam_medis;
use App\Models\Relasi_obat;
use App\Models\Riwayat_Obat;
use App\Models\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
// use function GuzzleHttp\Psr7\try_fopen;

class RekamMedisController extends Controller
{
    //
    public function index()
    {
        $rm = Rekam_medis::all();
        return view('manajemen.rm', compact('rm'));
    }

    public function show(Request $req)
    {
        $rm = Rekam_medis::find($req->id);
        $obat = Obat::all();
        if ($rm->status == false) {
            return redirect()->route('manajemen.rm.edit', $rm->id)->with('obat', $obat);
        }
        $pasien = Pasien::find($rm->pasien->id);
        $age = Carbon::parse($pasien->tgl_lahir)->age;
        return view('rekam-medis.lihat-rm')->with('rm', $rm)
            ->with('pasien', $pasien)
            ->with('age', $age);
    }

    public function edit($id)
    {
        try {
            //code...
            $obat = Obat::all();
            $rm = Rekam_medis::findorFail($id);
            $relasiobat = Relasi_obat::where('id_rekam_medis', '=', $rm->id)->get();
            if ($rm->status == true) {
                return redirect()->route('manajemen.rm.show', $rm->id)->with('transactionerror', 'Rekam medis sudah ditandai selesai, tidak dapat mengubah kembali data rekam medis!');
            }
        } catch (\Throwable $th) {
            throw $th;
            return redirect(route('home'))->with('redirected', 'Rekam Medis tidak ditemukan');
        }
        $pasien = Pasien::find($rm->pasien->id);
        $age = Carbon::parse($pasien->tgl_lahir)->age;
        return view('rekam-medis.edit-rm')->with('rm', $rm)
            ->with('pasien', $pasien)
            ->with('age', $age)
            ->with('obat', $obat)
            ->with('relasiobat', $relasiobat);
    }

    public function store(Request $req)
    {
        Request()->validate([
            'subyektif'     =>  'required_if:status,true',
            'obyektif'      =>  'required_if:status,true',
            'asessment'     =>  'required_if:status,true',
            'plan'          =>  'required_if:status,true',
            'diagnosis'     =>  'required_if:status,true',
            'tensi'         =>  'required_if:status,true',
            'nadi'          =>  'required_if:status,true',
            'nafas'         =>  'required_if:status,true',
            'suhu'          =>  'required_if:status,true',
            'berat'         =>  'required_if:status,true',
            'tinggi'        =>  'required_if:status,true',
            'tindakan'      =>  'required_if:status,true',
            'bmi'           =>  'required_if:status,true',
        ]);
        DB::beginTransaction();
        try {
            //code...
            $today = Carbon::today('Asia/Jakarta')->format('Y-m-d');
            Request()->validate([
                'status'    =>  'required_unless:agenda,null'
            ]);
            $rm = Rekam_medis::find($req->id);
            if ($req->agenda != null) {
                Request()->validate([
                    'agenda'    =>  'required',
                    'jadwal'    =>  ['required'],
                ]);
                $rm2 = new Rekam_medis;
                $dokter = Dokter::find($rm->id_dokter);
                $pasien = Pasien::find($rm->id_pasien);
                $rm2->dokter()->associate($dokter);
                $rm2->pasien()->associate($pasien);
                $jumlahrm = $pasien->rekam_medis()->count() + 1;
                $rm2->no_bag_rekmed = str_pad($jumlahrm, 3, '0', STR_PAD_LEFT);
                $rm2->save();
                $jadwal = new Jadwal;
                $jadwal->id_pasien = $rm->id_pasien;
                $jadwal->rekmed_awal()->associate($rm);
                $jadwal->rekmed_berikutnya()->associate($rm2);
                $jadwal->agenda = $req->agenda;
                $tgl_agenda = Carbon::createFromFormat('d/m/Y', $req->jadwal)
                ->format('Y-m-d');
                $jadwal->tgl_agenda = $tgl_agenda;
                $jadwal->save();
                
            }
            if ($req->status == true) {
                $rm->status = true;
                $antrian = Antrian::where('id_rekmed', '=', $rm->id)
                    ->where('status', '=', false)
                    ->latest();
                $antrian->update([
                    'status'    =>  true,
                ]);
            } else {
                $rm->status = false;
            }
            if ($req->jumlah != null) {
                Request()->validate([
                    'obat'      =>  'required',
                    'jumlah'    =>  'required|integer',
                    'signa'     =>  'required'
                ]);
                $obat = Obat::find($req->obat);
                if ($req->jumlah > $obat->stok) {
                    return back()->with('transactionerror', 'Jumlah yang dimasukkan lebih banyak daripada stok!');
                }
                try {
                    //code...
                    // $riwayat = Riwayat_Obat::create([
                    //     'id_obat'           =>  $obat->id,
                    //     'tipe'              =>  'Pengurangan',
                    //     'jumlah'            =>  $req->jumlah,
                    // ]);
                    $hasil = ($obat->stok - $req->jumlah);
                    $obat->update(['stok'   =>  $hasil]);
                    $obat->riwayat_obat()->create(
                        [
                            'tipe'     =>  'Pengurangan',
                            'jumlah'   =>  $req->jumlah,
                            'stok'     =>  $hasil,
                        ]
                    );
                    $rm->obat()->attach(
                        $obat->id,
                        [
                            'nama'      =>  $obat->nama,
                            'jumlah'    =>  $req->jumlah,
                            'signa'     =>  $req->signa
                        ]
                    );
                } catch (\Throwable $th) {
                    DB::rollback();
                    throw $th;
                    return back()->with('transactionerror', 'Gagal mengurangi stok obat!');
                }
            }
            $rm->update([
                'subyektif'     =>  $req->subyektif,
                'obyektif'      =>  $req->obyektif,
                'asessment'     =>  $req->asessment,
                'plan'          =>  $req->plan,
                'diagnosis'     =>  $req->diagnosis,
                'tensi'         =>  $req->tensi,
                'nadi'          =>  $req->nadi,
                'nafas'         =>  $req->nafas,
                'suhu'          =>  $req->suhu,
                'berat'         =>  $req->berat,
                'tinggi'        =>  $req->tinggi,
                'tgl_rekam'     =>  $today,
                'tindakan'      =>  $req->tindakan,
                'bmi'           =>  $req->bmi,
            ]);
            $rm->save();
            DB::commit();
        } catch (\Exception $th) {
            DB::rollback();
            throw $th;
            return back()->with('transactionerror', 'Form tidak valid');
        }
        if ($rm->status == true) {
            return Redirect(route('manajemen.rm.show', $rm->id))->with('success', 'Data berhasil disimpan');
        } else {
            return Redirect(route('manajemen.rm.edit', $rm->id))->with('success', 'Data berhasil disimpan');
        }
    }
}
