@extends('admin.layout.master')

@section('title', 'Input Data delivery')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Form delivery</h3>
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

                        <form action="/delivery/store" method="post">
                            @csrf      
                            <div class="form-group">
                                <label for="no_do">No DO</label>
                                <input type="text" name="no_do" id="no_do" value="{{$no_delivery}}" readonly class="form-control" required>
                            </div>             
                            <div class="form-group">
                                <label for="pelanggan_id">Nama Pelanggan</label>
                                <select name="pelanggan_id" id="pelanggan_id" class="form-control" required>
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach($pelanggan as $s)
                                        <option value="{{ $s->id }}">{{ $s->nama_pelanggan }}</option>
                                    @endforeach
                                </select>
                            </div>  
                            <div class="form-group">
                                <label for="jenis_semen">Jenis Semen</label>
                                <select name="jenis_id" id="jenis_id" class="form-control" required>
                                    <option value="">Pilih Jenis Semen</option>
                                    @foreach($jenis as $s)
                                        <option value="{{ $s->id }}">{{ $s->nama_jenis }}</option>
                                    @endforeach
                                </select>
                            </div>         
                            <div class="form-group">
                                <label for="tanggal_delivery">Jumlah Semen:</label>
                                <input type="number" name="jumlah_semen" id="jumlah_semen" class="form-control" required>
                            </div>                     
                            <div class="form-group">
                                <label for="tanggal_delivery">Tanggal Pemesanan:</label>
                                <input type="date" name="tanggal_pemesanan" id="tanggal_pemesanan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="waktu_delivery">Waktu Pemesanan:</label>
                                <input type="time" name="waktu_pemesanan" id="waktu_pemesanan" class="form-control" required>
                            </div>                  
                            
                            <button type="submit" class="btn btn-success">Simpan delivery</button>
                            <a href="/delivery" class="btn btn-danger">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk mengisi input waktu dengan waktu saat ini
    function setCurrentTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const currentTime = `${hours}:${minutes}`;
        document.getElementById('waktu_pemesanan').value = currentTime;
    }

    // Panggil fungsi saat halaman dimuat
    window.onload = setCurrentTime;
</script>
@endsection
