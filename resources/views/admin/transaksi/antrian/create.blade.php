@extends('admin.layout.master')

@section('title', 'Input Data delivery')

@section('content')

<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Form Antrian</h3>
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

                        <form action="/antrian/store" method="post">
                            @csrf      
                            
                            <div class="form-group">
                                <label for="delivery_id">No DO</label>
                                <select name="delivery_id" id="delivery_id" class="form-control" required>
                                    <option value="">Pilih No DO</option>
                                    @foreach($delivery as $s)
                                        <option value="{{ $s->id }}">{{ $s->no_do }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nomor_kendaraan">Nomor Kendaraan:</label>
                                <input type="text" name="nomor_kendaraan" id="nomor_kendaraan" class="form-control" required>
                            </div>    
                            <div class="form-group">
                                <label for="nama_pengemudi">Nama Pengemudi:</label>
                                <input type="text" name="nama_pengemudi" id="nama_pengemudi" class="form-control" required>
                            </div>                     
                            <div class="form-group">
                                <label for="tanggal_">Tanggal kedatangan:</label>
                                <input type="date" name="tanggal_kedatangan" id="tanggal_kedatangan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="waktu_delivery">Waktu kedatangan:</label>
                                <input type="time" name="waktu_kedatangan" id="waktu_kedatangan" class="form-control" required>
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
        document.getElementById('waktu_kedatangan').value = currentTime;
    }

    // Panggil fungsi saat halaman dimuat
    window.onload = setCurrentTime;
</script>
@endsection
