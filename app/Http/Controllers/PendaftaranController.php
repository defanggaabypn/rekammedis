<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Pasien;
use App\Models\Rekam_medis;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PendaftaranController extends Controller
{
    //
    public function index()
    {
        $dokters = Dokter::all();
        $pasiens = Pasien::all();
        $antrian = Antrian::all();
        $today = Carbon::today('Asia/Jakarta');
        $rm = Rekam_medis::orderByDesc('updated_at')->get();
        // $totalrm = Rekam_medis::all()->count();
        return view('master/pendaftaran')->with('dokters', $dokters)
            ->with('pasiens', $pasiens)
            ->with('antrian', $antrian)
            ->with('rm', $rm);
        // ->with('totalrm', $totalrm);
    }

    public function storenew(Request $req)
    {
        Request()->validate([
            'nama'          =>  'required',
            'NIK'           =>  'required|unique:pasiens,NIK',
            'tgl_lahir'     =>  'required',
            'kelamin'       =>  'required',
            // 'alamat'        =>  'required',
            'no_telp'       =>  'required',
            'email'         =>  'email',
            'pj'            =>  'required',
            'photo'         =>  ['mimes:png,jpeg,jpg', 'nullable'],
            'aksi'          =>  'required',
            'pekerjaan'     =>  'required',
        ]);
        $newDate = Carbon::createFromFormat('m/d/Y', $req->tgl_lahir)
            ->format('Y-m-d');

        switch ($req->input('aksi')) {
            case '1':
                DB::beginTransaction();
                try {
                    if ($req->hasFile('image')) {
                        $destination_path = 'public/pasien';
                        $image = $req->file('image');
                        $image_name = $image->getClientOriginalName() . '(' . $req->NIK . ')';
                        $path = $req->file('image')->storeAs($destination_path, $image_name);
                        $photo = Storage::url($path);
                        $newphoto = $image_name;
                    } else {
                        $newphoto = '';
                    }
                    $pasien = Pasien::Create(
                        [
                            'nama'          =>  $req->nama,
                            'NIK'           =>  $req->NIK,
                            'email'         =>  $req->email,
                            'tgl_lahir'     =>  $newDate,
                            'kelamin'       =>  $req->kelamin,
                            // 'alamat'        =>  $req->alamat,
                            'no_telp'       =>  $req->no_telp,
                            'photo'         =>  $newphoto,
                            'pekerjaan'     =>  $req->pekerjaan,
                            'pj'            =>  $req->pj,
                        ],
                    );
                    $pasien->no_rekmed = "rm-" . str_pad($pasien->id, 4, '0', STR_PAD_LEFT);
                    $pasien->update();
                    DB::commit();
                } catch (\Exception $th) {
                    DB::rollback();
                    // return back()->with('transactionerror', $th);
                    throw $th;
                }
                return back()->with('success', 'Data berhasil ditambahkan');
            case '2':
                DB::beginTransaction();
                try {
                    //code...
                    if ($req->hasFile('image')) {
                        $destination_path = 'public/pasien';
                        $image = $req->file('image');
                        $image_name = $image->getClientOriginalName() . '(' . $req->NIK . ')';
                        $path = $req->file('image')->storeAs($destination_path, $image_name);
                        $photo = Storage::url($path);
                        $newphoto = $image_name;
                    } else {
                        $newphoto = '';
                    }
                    $pasien = Pasien::Create(
                        [
                            'nama'          =>  $req->nama,
                            'NIK'           =>  $req->NIK,
                            'email'         =>  $req->email,
                            'tgl_lahir'     =>  $newDate,
                            'kelamin'       =>  $req->kelamin,
                            'no_telp'       =>  $req->no_telp,
                            'photo'         =>  $newphoto,
                            'pekerjaan'     =>  $req->pekerjaan,
                            'pj'            =>  $req->pj,
                        ],
                    );
                    $pasien->no_rekmed = "rm-" . str_pad($pasien->id, 4, '0', STR_PAD_LEFT);
                    $pasien->save();
                    $dokter = Dokter::find($req->dokter);
                    $rm = new Rekam_medis;
                    $jumlahrm = $pasien->rekam_medis()->count() + 1;
                    $rm->dokter()->associate($dokter);
                    $rm->pasien()->associate($pasien);
                    $rm->no_bag_rekmed = str_pad($jumlahrm, 3, '0', STR_PAD_LEFT);
                    $rm->save();
                    $antrian = new Antrian;
                    $antrian->pasien()->associate($pasien);
                    $antrian->rekam_medis()->associate($rm);
                    $today = Carbon::today('Asia/Jakarta')->format('Y-m-d');
                    $antrian->tgl_antri = $today;
                    $antrian->save();
                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollback();
                    throw $th;
                    // return back()->with('transactionerror', $th);
                }
                return back()->with('success', 'Data berhasil ditambahkan');
        };
    }

    public function storeold(Request $req)
    {
        Request()->validate([
            'dokter'        =>  'required',
            'pasien'        =>  'required',
        ]);
        DB::beginTransaction();
        try {
            //code...
            $pasien = Pasien::find($req->pasien);
            $dokter = Dokter::find($req->dokter);
            $rm = new Rekam_medis;
            $jumlahrm = $pasien->rekam_medis()->count() + 1;
            $rm->dokter()->associate($dokter);
            $rm->pasien()->associate($pasien);
            $rm->no_bag_rekmed = str_pad($jumlahrm, 3, '0', STR_PAD_LEFT);
            $rm->save();
            $antrian = new Antrian;
            $antrian->pasien()->associate($pasien);
            $antrian->rekam_medis()->associate($rm);
            $today = Carbon::now('Asia/Jakarta')->format('Y-m-d');
            $antrian->tgl_antri = $today;
            $antrian->save();
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return back()->with('transactionerror', $th);
            throw $th;
        }
        return back()->with('success', 'Data berhasil ditambahkan');
    }
}
