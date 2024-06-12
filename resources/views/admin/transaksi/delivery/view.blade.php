@extends('admin.layout.master')

@section('title', 'Input Data Pengembalian')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Form Pengembalian</h3>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_content">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form action="/pengembalian/update/{{$rental->id}}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="no_po">No Invoice</label>
                                <input type="text" value="{{$rental->no_invoice}}" name="no_invoice" id="no_invoice" class="form-control" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="pelanggan_id">Pelanggan:</label>
                                <select name="pelanggan_id" id="pelanggan_id" class="form-control" required disabled>
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach($pelanggan as $s)
                                        <option value="{{ $s->id }}" {{ $rental->pelanggan_id == $s->id ? 'selected' : '' }}>
                                            {{ $s->nama_pelanggan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="alat_id">Nama Alat:</label>
                                <select name="alat_id" id="alat_id" class="form-control" required disabled>
                                    <option value="">Pilih Alat</option>
                                    @foreach($alat as $s)
                                        <option value="{{ $s->id }}" data-harga="{{ $s->harga_perhari }}" data-denda="{{ $s->denda_perhari }}" {{$rental->alat_id == $s->id ? 'selected' : ''}}>{{$s->Jenis->nama_jenis}} || {{ $s->merk }} || {{$s->type}} || {{ $s->harga_perhari }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="alat_id" value="{{ $rental->alat_id }}">
                            </div>
                            <div class="form-group">
                                <label for="tanggal_sewa">Tanggal Sewa:</label>
                                <input type="date" value="{{$rental->tanggal_sewa}}" name="tanggal_sewa" id="tanggal_sewa" class="form-control" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_kembali">Tanggal Kembali:</label>
                                <input type="date" value="{{$rental->tanggal_kembali}}" name="tanggal_kembali" id="tanggal_kembali" class="form-control" required readonly>
                            </div>
                            <div class="form-group">
                                <label for="lama_sewa">Lama Sewa</label>
                                <input type="text" value="{{$rental->lama_sewa}}" name="lama_sewa" id="lama_sewa" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="biaya_sewa">Biaya Sewa</label>
                                <input type="text" value="{{$rental->biaya_sewa}}" name="biaya_sewa" id="biaya_sewa" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="status_pembayaran">Status Pembayaran:</label>
                                <select name="status_pembayaran" id="status_pembayaran" class="form-control" required disabled>
                                    <option value="">Pilih Status</option>
                                    <option value="Belum Bayar" {{ $rental->status_pembayaran == 'Belum Bayar' ? 'selected' : '' }}>Belum Bayar</option>
                                    <option value="Sudah Bayar" {{ $rental->status_pembayaran == 'Sudah Bayar' ? 'selected' : '' }}>Sudah Bayar</option>
                                </select>
                            </div>     
                            <div class="form-group">
                                <label for="tanggal_pengembalian">Tanggal Pengembalian:</label>
                                <input type="date" value="{{$rental->tanggal_pengembalian}}"  name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label for="status_pengembalian">Status Pengembalian:</label>
                                <input type="text" value="{{$rental->status_pengembalian}}" name="status_pengembalian" id="status_pengembalian" class="form-control" readonly>
                            </div>   
                            <div class="form-group">
                                <label for="denda_perhari">Denda</label>
                                <input type="text" value="{{$rental->denda_perhari}}" name="denda_perhari" id="denda_perhari" class="form-control" readonly>
                            </div>    
                            <div class="form-group">
                                <label for="total_pembayaran">Total Pembayaran</label>
                                <input type="text" value="{{$rental->total_pembayaran}}" name="total_pembayaran" id="total_pembayaran" class="form-control" readonly>
                            </div>                  
                            
                            {{-- <button type="submit" class="btn btn-success">Simpan</button> --}}
                            <a href="/pengembalian" class="btn btn-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alatSelect = document.getElementById('alat_id');
        const tanggalSewaInput = document.getElementById('tanggal_sewa');
        const tanggalKembaliInput = document.getElementById('tanggal_kembali');
        const tanggalPengembalianInput = document.getElementById('tanggal_pengembalian');
        const biayaSewaInput = document.getElementById('biaya_sewa');
        const lamaSewaInput = document.getElementById('lama_sewa');
        const statusPengembalianInput = document.getElementById('status_pengembalian');
        const dendaInput = document.getElementById('denda_perhari');
    const totalPembayaranInput = document.getElementById('total_pembayaran');

    document.getElementById('alat_id').addEventListener('change', function(event) {
        this.value = '{{ $rental->alat_id }}';
    });

        function calculateBiayaSewa() {
            const alatOption = alatSelect.options[alatSelect.selectedIndex];
            const hargaPerHari = alatOption.getAttribute('data-harga');
            const tanggalSewa = new Date(tanggalSewaInput.value);
            const tanggalKembali = new Date(tanggalKembaliInput.value);
            
            if (hargaPerHari && tanggalSewa && tanggalKembali && tanggalKembali >= tanggalSewa) {
                const diffTime = Math.abs(tanggalKembali - tanggalSewa);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // Termasuk hari sewa dan hari kembali
                const biayaSewa = diffDays * hargaPerHari;
                biayaSewaInput.value = biayaSewa;
            } else {
                biayaSewaInput.value = '';
            }
        }

        function calculateLamaSewa() {
            const tanggalSewa = new Date(tanggalSewaInput.value);
            const tanggalKembali = new Date(tanggalKembaliInput.value);
            
            if (tanggalSewa && tanggalKembali && tanggalKembali >= tanggalSewa) {
                const diffTime = Math.abs(tanggalKembali - tanggalSewa);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // Termasuk hari sewa dan hari kembali
                lamaSewaInput.value = diffDays + ' hari';
            } else {
                lamaSewaInput.value = '';
            }
        }

        function updateStatusPengembalian() {
            const tanggalKembali = new Date(tanggalKembaliInput.value);
            const tanggalPengembalian = new Date(tanggalPengembalianInput.value);

            if (tanggalPengembalian > tanggalKembali) {
                statusPengembalianInput.value = 'Terlambat';
            } else {
                statusPengembalianInput.value = 'Tepat Waktu';
            }
        }

        function calculateDenda() {
        const tanggalKembali = new Date(tanggalKembaliInput.value);
        const tanggalPengembalian = new Date(tanggalPengembalianInput.value);
        const dendaPerHari = 50000; // Contoh nilai denda per hari, sesuaikan dengan kebutuhan
        let denda = 0;

        if (tanggalPengembalian > tanggalKembali) {
            const diffTime = Math.abs(tanggalPengembalian - tanggalKembali);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            denda = diffDays * dendaPerHari;
            statusPengembalianInput.value = 'Terlambat';
        } else {
            statusPengembalianInput.value = 'Tepat Waktu';
        }

        dendaInput.value = denda;
        calculateTotalPembayaran(denda);
    }

    function calculateTotalPembayaran(denda) {
        const biayaSewa = parseFloat(biayaSewaInput.value) || 0;
        const totalPembayaran = biayaSewa + denda;
        totalPembayaranInput.value = totalPembayaran;
    }

    tanggalPengembalianInput.addEventListener('change', () => {
        calculateDenda();
    });

    // Inisialisasi perhitungan denda saat halaman dimuat
    calculateDenda();

        alatSelect.addEventListener('change', () => {
            calculateBiayaSewa();
            calculateLamaSewa();
        });
        tanggalSewaInput.addEventListener('change', () => {
            calculateBiayaSewa();
            calculateLamaSewa();
        });
        tanggalKembaliInput.addEventListener('change', () => {
            calculateBiayaSewa();
            calculateLamaSewa();
            updateStatusPengembalian();
        });
        tanggalPengembalianInput.addEventListener('change', () => {
            updateStatusPengembalian();
        });
    
        // Inisialisasi status pengembalian saat halaman dimuat
        updateStatusPengembalian();
    });
</script>

@endsection
