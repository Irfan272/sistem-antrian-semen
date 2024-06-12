<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(){
        $pelanggan = Pelanggan::all();
        return view("admin.master_data.pelanggan.index", compact("pelanggan"));
    }

    public function create(){
        return view("admin.master_data.pelanggan.create");
    }

    public function store(Request $request){
        $request->validate([
            'no_ktp' => 'required',
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
           
        ]);

        $data = [
            'no_ktp' => $request->input('no_ktp'),
            'nama_pelanggan' => $request->input('nama_pelanggan'),
            'alamat' => $request->input('alamat'),
            'no_telpon' => $request->input('no_telpon'),
            'email' => $request->input('email'),
            
        ];

        // Menyimpan data ke dalam database menggunakan model Alat
        Pelanggan::create($data);
        
        return redirect('/pelanggan')->with('status','Data Berhasil Ditambah');
    }

    public function edit($id){
        $pelanggan = Pelanggan::where('id', $id)->get();

        return view('admin.master_data.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'no_ktp' => 'required',
            'nama_pelanggan' => 'required',
            'alamat' => 'required',
            'no_telpon' => 'required',
            'email' => 'required',
           
        ]);

        $data = [
            'no_ktp' => $request->input('no_ktp'),
            'nama_pelanggan' => $request->input('nama_pelanggan'),
            'alamat' => $request->input('alamat'),
            'no_telpon' => $request->input('no_telpon'),
            'email' => $request->input('email'),
          
        ];

        Pelanggan::where('id', $id)->update($data);

        return redirect('/pelanggan')->with('status','Data Berhasil Di Edit');
    }

    public function delete($id){
        Pelanggan::destroy($id);
        return redirect('/pelanggan')->with('status','Berhasil Dihapus');
    }

    public function view($id){
        $pelanggan = Pelanggan::where('id', $id)->get();

        return view('admin.master_data.pelanggan.view', compact('pelanggan'));
    }
}
