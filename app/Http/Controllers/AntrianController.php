<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\DeliveryOrder;
use Illuminate\Http\Request;

class AntrianController extends Controller
{
    public function index()
    {
        $antrian = Antrian::with('DeliveryOrder')->get();
        return view("security.transaksi.antrian.index", compact("antrian"));
    }


    public function create()
    {
        $delivery = DeliveryOrder::all();
        return view("security.transaksi.antrian.create", compact("delivery"));
    }



    public function store(Request $request)
    {
        $request->validate([
            'delivery_id' => 'required',
            'nomor_kendaraan' => 'required',
            'nama_pengemudi' => 'required',
            'tanggal_kedatangan' => 'required|date_format:Y-m-d',
            'waktu_kedatangan' => 'required|date_format:H:i',
        ]);

        // Gabungkan tanggal dan waktu menjadi satu format datetime
        $tanggal_kedatangan = $request->input('tanggal_kedatangan');
        $waktu_kedatangan = $request->input('waktu_kedatangan');
        $waktu_kedatangan_full = $tanggal_kedatangan . ' ' . $waktu_kedatangan . ':00';

        $data = [
            'delivery_id' => $request->input('delivery_id'),
            'nomor_kendaraan' => $request->input('nomor_kendaraan'),
            'nama_pengemudi' => $request->input('nama_pengemudi'),
            'waktu_kedatangan' => $waktu_kedatangan_full,
            'status' => "Menunggu",
        ];

        // Menyimpan data ke dalam database menggunakan model delivery
        Antrian::create($data);

        // Redirect dengan pesan sukses
        return redirect('/antrian')->with('status', 'Data Berhasil Ditambah');

    }

    public function edit($id)
    {
        $delivery = DeliveryOrder::all();
        $antrian = Antrian::findOrFail($id);

        return view('security.transaksi.antrian.edit', compact('antrian', 'delivery'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'delivery_id' => 'required',
            'nomor_kendaraan' => 'required',
            'nama_pengemudi' => 'required',
            'tanggal_kedatangan' => 'required|date_format:Y-m-d',
            'waktu_kedatangan' => 'required|date_format:H:i',
        ]);

        // Gabungkan tanggal dan waktu menjadi satu format datetime
        $tanggal_kedatangan = $request->input('tanggal_kedatangan');
        $waktu_kedatangan = $request->input('waktu_kedatangan');
        $waktu_kedatangan_full = $tanggal_kedatangan . ' ' . $waktu_kedatangan . ':00';

        $data = [
            'delivery_id' => $request->input('delivery_id'),
            'nomor_kendaraan' => $request->input('nomor_kendaraan'),
            'nama_pengemudi' => $request->input('nama_pengemudi'),
            'waktu_kedatangan' => $waktu_kedatangan_full,
            'status' => $request->input('status'),
        ];



        // Perbarui data di database
        Antrian::where('id', $id)->update($data);

        // Redirect dengan pesan sukses
        return redirect('/antrian')->with('status', 'Data Berhasil Di Edit');
    }
    public function delete($id)
    {
        Antrian::destroy($id);
        return redirect('/antrian')->with('status', 'Berhasil Dihapus');
    }
}
