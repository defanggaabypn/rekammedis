<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\Perawat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PerawatController extends Controller
{
    //

    public function index()
    {
        $perawat = Perawat::where('active', '=', true)->get();
        return view('manajemen/perawat')
            ->with('perawat', $perawat);
    }

    public function store(Request $req)
    {
        Request()->validate([
            'nama'          =>  'required',
            'tgl_lahir'     =>  'required',
            'kelamin'       =>  'required',
            'alamat'        =>  'required',
            'no_telp'       =>  'required',
            'email'         =>  'required',
            'alumni'        =>  'required',
            'photo'         =>  ['nullable', 'mimes:png,jpeg,jpg'],
        ]);

        DB::beginTransaction();
        try {
            //code...
            $newDate = Carbon::createFromFormat('m/d/Y', $req->tgl_lahir)
                ->format('Y-m-d');
            $newPhone = (string)$req->no_telp;
            $perawat = Perawat::create([
                'nama'      =>  $req->nama,
                'tgl_lahir' =>  $newDate,
                'kelamin'   =>  $req->kelamin,
                'alamat'    =>  $req->alamat,
                'no_telp'   =>  $newPhone,
                'email'     =>  $req->email,
                'alumni'    =>  $req->alumni
            ]);
            if ($req->hasFile('image')) {
                $destination_path = 'public/perawat';
                $image = $req->file('image');
                $image_name = $image->getClientOriginalName() . '(' . $req->nama . ')';
                $path = $req->file('image')->storeAs($destination_path, $image_name);
                $photo = Storage::url($path);
                $newphoto = $image_name;
                $perawat->photo = $newphoto;
            }
            DB::commit();
        } catch (\Exception $th) {
            //throw $th;
            DB::rollback();
            return back()->with('transactionerror', $th);
        }
        return back()->with('success', 'Data perawat berhasil ditambahkan!');
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            //code...
            $perawat = Perawat::find($id);
            $perawat->active = false;
            $perawat->save();
            DB::commit();
        } catch (\Exception $th) {
            //throw $th;
            DB::rollback();
            return back()->with('transactionerror', 'Gagal menghapus data perawat');
        }
        return back()->with('success', 'Data perawat berhasil dihapus!');
    }
}
