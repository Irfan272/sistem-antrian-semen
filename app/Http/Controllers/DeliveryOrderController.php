<?php

namespace App\Http\Controllers;

use App\Models\DeliveryOrder;
use App\Models\JenisSemen;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class DeliveryOrderController extends Controller
{
    public function index()
    {
        $delivery = DeliveryOrder::with('JenisSemen', 'Pelanggan')->get();
        return view("admin.transaksi.delivery.index", compact("delivery"));
    }

    private function generate_unique_no_delivery()
    {
        $prefix = 'AB'; // Awalan untuk nomor PO (opsional)
        $last_po = DeliveryOrder::max('id'); // Mendapatkan ID terakhir dari tabel Pembelian

        $seq_number = $last_po ? ($last_po + 1) : 1; // Nomor urut berdasarkan ID terakhir
        $no_do = "{$prefix}-{$seq_number}";

        return $no_do;
    }

    public function create()
    {
        $jenis = JenisSemen::all();
        $no_delivery = $this->generate_unique_no_delivery();
        $pelanggan = Pelanggan::all();
        return view("admin.transaksi.delivery.create", compact("jenis", "no_delivery", "pelanggan"));
    }



    public function store(Request $request)
    {
        $request->validate([
            'no_do' => 'required',
            'pelanggan_id' => 'required',
            'jenis_id' => 'required',
            'jumlah_semen' => 'required',
            'tanggal_pemesanan' => 'required|date_format:Y-m-d',
            'waktu_pemesanan' => 'required|date_format:H:i',
        ]);

        // Gabungkan tanggal dan waktu menjadi satu format datetime
        $tanggal_pemesanan = $request->input('tanggal_pemesanan');
        $waktu_pemesanan = $request->input('waktu_pemesanan');
        $waktu_pemesanan_full = $tanggal_pemesanan . ' ' . $waktu_pemesanan . ':00';

        $data = [
            'no_do' => $request->input('no_do'),
            'pelanggan_id' => $request->input('pelanggan_id'),
            'jenis_id' => $request->input('jenis_id'),
            'jumlah_semen' => $request->input('jumlah_semen'),
            'waktu_pemesanan' => $waktu_pemesanan_full,
            'status' => "Menunggu",
        ];

        // Menyimpan data ke dalam database menggunakan model delivery
        DeliveryOrder::create($data);

        // Redirect dengan pesan sukses
        return redirect('/delivery')->with('status', 'Data Berhasil Ditambah');

    }

    public function edit($id)
    {
        $jenis = JenisSemen::all();
        $pelanggan = Pelanggan::all();
        $delivery = DeliveryOrder::findOrFail($id);

        return view('admin.transaksi.delivery.edit', compact('delivery', 'jenis', 'pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'no_do' => 'required',
            'pelanggan_id' => 'required',
            'jenis_id' => 'required',
            'jumlah_semen' => 'required',
            'tanggal_pemesanan' => 'required|date_format:Y-m-d',
            'waktu_pemesanan' => 'required|date_format:H:i',
            'status' => 'required',
        ]);

        // Gabungkan tanggal dan waktu menjadi satu format datetime
        $tanggal_pemesanan = $request->input('tanggal_pemesanan');
        $waktu_pemesanan = $request->input('waktu_pemesanan');
        $waktu_pemesanan_full = $tanggal_pemesanan . ' ' . $waktu_pemesanan . ':00';

        $data = [
            'no_do' => $request->input('no_do'),
            'pelanggan_id' => $request->input('pelanggan_id'),
            'jenis_id' => $request->input('jenis_id'),
            'jumlah_semen' => $request->input('jumlah_semen'),
            'waktu_pemesanan' => $waktu_pemesanan_full,
            'status' => $request->input('status'),
        ];


        // Perbarui data di database
        DeliveryOrder::where('id', $id)->update($data);

        // Redirect dengan pesan sukses
        return redirect('/delivery')->with('status', 'Data Berhasil Di Edit');
    }
    public function delete($id)
    {
        DeliveryOrder::destroy($id);
        return redirect('/delivery')->with('status', 'Berhasil Dihapus');
    }
}
