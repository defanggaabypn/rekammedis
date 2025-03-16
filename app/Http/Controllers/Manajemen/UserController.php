<?php

namespace App\Http\Controllers\Manajemen;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('manajemen.akun.akun', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $validator = $request->validate([
            'username' => 'required|unique:App\Models\User,username',
            'nama' => 'required',
            'role' => 'required',
            'password' => 'required|alpha_num'
        ]);
        
        $userData = [
            'username' => $request->username,
            'nama' => $request->nama,
            'role' => $request->role,
            'password' => bcrypt($request->password)
        ];
        
        if ($request->role === 'owner' || $request->role === 'staff') {
            // field tambahan untuk owner/staff
            $userData['jenis_kelamin'] = $request->jenis_kelamin;
            $userData['tanggal_lahir'] = $request->tanggal_lahir;
            $userData['email'] = $request->email;
            $userData['no_telp'] = $request->no_telp;
            $userData['alamat'] = $request->alamat;
        }
        
        $user->create($userData);
        return redirect()->route('manajemen-akun.index')->with('success', 'Akun berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('manajemen.akun.akun', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('manajemen-akun.index');
    }
}
