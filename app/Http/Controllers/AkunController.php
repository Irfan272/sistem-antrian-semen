<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AkunController extends Controller
{
    public function index()
    {
        $akun = User::all();
        return view('admin.master_data.akun.index', compact('akun'));
    }

    public function create()
    {
        return view('admin.master_data.akun.create');
    }

    public function store(Request $request)
    {
        $validasiData = $request->validate([
            'username' => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:20',
            'role' => 'required|string|max:255',



        ]);
        $validasiData['password'] = Hash::make($validasiData['password']);
      

        User::create($validasiData);



        return redirect('/akun')->with('status', 'Data berhasil ditambah.');
    }

    public function edit($id)
    {
        $akun = User::where('id', $id)->get();

        return view('admin.master_data.akun.edit', compact('akun'));
    }

    public function update(Request $request, $id)
    {
        $validasiData = $request->validate([


            'username' => 'required|string|max:255',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|max:20',
            'role' => 'required|string|max:255',
        ]);
        $validasiData['password'] = Hash::make($validasiData['password']);
       
        User::where('id', $id)->update($validasiData);

        return redirect('/akun')->with('status', 'Data berhasil diedit.');;
    }

    public function delete($id)
    {
        User::destroy($id);
        return back();
    }
}
