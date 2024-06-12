<?php

namespace App\Http\Controllers;

use App\Models\JenisSemen;
use Illuminate\Http\Request;

class JenisSemenController extends Controller
{
    public function index(){
        $jenis = JenisSemen::all();
        return view("admin.master_data.Jenis.index", compact("jenis"));
    }

    public function create(){
        return view("admin.master_data.Jenis.create");
    }

    public function store(Request $request){
        $validasiData = $request->validate([
            'nama_jenis' => 'required',
           
        ]);
        JenisSemen::create($validasiData);
        
        return redirect('/jenis')->with('status','Data Berhasil Ditambah');
    }

    public function edit($id){
        $jenis = JenisSemen::where('id', $id)->get();

        return view('admin.master_data.Jenis.edit', compact('jenis'));
    }

    public function update(Request $request, $id){
        $validasiData = $request->validate([
            'nama_jenis' => 'required',
        ]);

        JenisSemen::where('id', $id)->update($validasiData);

        return redirect('/jenis')->with('status','Data Berhasil Di Edit');
    }

    public function delete($id){
        JenisSemen::destroy($id);
        return redirect('/jenis')->with('status','Berhasil Dihapus');
    }
}
