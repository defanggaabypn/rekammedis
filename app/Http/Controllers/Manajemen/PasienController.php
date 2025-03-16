<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PasienController extends Controller
{
    //

    public function index()
    {
        $pasiens = Pasien::all()/*->fragment('$pasiens')*/;
        $totalpasien = Pasien::all()->count();
        return view('manajemen/pasien')
            ->with('pasiens', $pasiens)
            ->with('totalpasien', $totalpasien);
    }

    public function edit(Request $req)
    {
        Request()->validate([
            'nama'          =>  'required',
            'NIK'           =>  'required|unique:pasiens,NIK,' . $req->id,
            'tgl_lahir'     =>  'required|date_format:Y-m-d',
            'kelamin'       =>  'required',
            // 'alamat'        =>  'required',
            'no_telp'       =>  'required',
            'email'         =>  'email',
            'pj'            =>  'required',
            'photo'         =>  ['mimes:png,jpeg,jpg', 'nullable'],
            'pekerjaan'     =>  'required',
        ]);
        DB::beginTransaction();
        try {
            //code...
            $newphoto = null;
            $newDate = Carbon::createFromFormat('Y-m-d', $req->tgl_lahir)
                ->format('Y-m-d');
            $pasien = Pasien::find($req->id);
            $pasien->update(
                [
                    'nama'          =>  $req->nama,
                    'NIK'           =>  $req->NIK,
                    'email'         =>  $req->email,
                    'tgl_lahir'     =>  $newDate,
                    'kelamin'       =>  $req->kelamin,
                    // 'alamat'        =>  $req->alamat,
                    'no_telp'       =>  $req->no_telp,
                    'pekerjaan'     =>  $req->pekerjaan,
                    'pj'            =>  $req->pj,
                ],
            );
            if ($req->hasFile('image')) {
                $destination_path = 'public/pasien';
                $image = $req->file('image');
                $image_name = $image->getClientOriginalName() . '(' . $req->NIK . ')';
                $path = $req->file('image')->storeAs($destination_path, $image_name);
                $photo = Storage::url($path);
                $newphoto = $image_name;
                $pasien->photo = $newphoto;
            }
            $pasien->save();
            DB::commit();
        } catch (\Exception $th) {
            //throw $th;
            DB::rollback();
            dd($th);
            return back()->with('transactionerror', 'Data gagal di upate, perhatikan Inputan form');
        }
        return back()->with('success', 'Data pasien berhasil di-update!');
    }
}
