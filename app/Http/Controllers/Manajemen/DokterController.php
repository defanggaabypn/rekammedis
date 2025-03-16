<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DokterController extends Controller
{
    //

    public function index()
    {
        $dokter = Dokter::where('active', '=', true)->get();
        return view('manajemen/dokter')
            ->with('dokter', $dokter);
    }

    public function store(Request $req)
    {
        Request()->validate([
            'nama'          =>  'required',
            'tgl_lahir'     =>  'required',
            'kelamin'       =>  'required',
            'spesialis'     =>  'required',
            'alamat'        =>  'required',
            'no_telp'       =>  'required',
            'email'         =>  'required',
            'alumni'        =>  'required',
            'photo'         =>  'nullable|mimes:png,jpeg,jpg',
        ]);

        DB::beginTransaction();
        try {
            //code...
            $newDate = Carbon::createFromFormat('m/d/Y', $req->tgl_lahir)
                ->format('Y-m-d');
            $newPhone = (string)$req->no_telp;
            $dokter = Dokter::create([
                'nama'      =>  $req->nama,
                'tgl_lahir' =>  $newDate,
                'kelamin'   =>  $req->kelamin,
                'spesialis' =>  $req->spesialis,
                'alamat'    =>  $req->alamat,
                'no_telp'   =>  $newPhone,
                'email'     =>  $req->email,
                'alumni'    =>  $req->alumni
            ]);
            
            // Perbaikan di sini - memeriksa 'photo' bukan 'image'
            if ($req->hasFile('photo')) {
                $destination_path = 'public/dokter'; // Ubah path ke dokter
                $image = $req->file('photo');
                $image_name = $dokter->id . '_' . time() . '.' . $image->getClientOriginalExtension();
                $path = $req->file('photo')->storeAs($destination_path, $image_name);
                $dokter->photo = 'storage/dokter/' . $image_name; // Perbaikan path foto
                $dokter->save(); // Jangan lupa save perubahan
            }
            
            DB::commit();
        } catch (\Exception $th) {
            //throw $th;
            DB::rollback();
            dd($th);
            return back()->with('transactionerror', 'Data gagal ditambahkan!');
        }
        return back()->with('success', 'Data Dokter berhasil ditambahkan!');
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            //code...
            $dokter = Dokter::find($id);
            $dokter->active = false;
            $dokter->save();
            DB::commit();
        } catch (\Exception $th) {
            //throw $th;
            DB::rollback();
            return back()->with('transactionerror', 'Gagal menghapus data dokter');
        }
        return back()->with('success', 'Data dokter berhasil dihapus!');
    }

    public function getData()
    {
        $dokter = Dokter::where('active', '=', true)->select('id', 'nama')->get();
        return response()->json($dokter);
    }
    
    public function getDetail($id)
    {
        $dokter = Dokter::find($id);
        return response()->json($dokter);
    }
}