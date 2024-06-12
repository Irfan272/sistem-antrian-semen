@extends('security.layout.master')

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

                        <form action="/antrian/update/{{$antrian->id}}" method="post">
                            @csrf
                            @method('PATCH')                               
                            <div class="form-group">
                                <label for="delivery_id">No DO</label>
                                <select name="delivery_id" id="delivery_id" class="form-control" required>
                                    <option value="">Pilih No DO</option>
                                    @foreach($delivery as $s)
                                        <option value="{{ $s->id }}" {{ $antrian->delivery_id == $s->id ? 'selected' : '' }}>{{ $s->no_do }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nomor_kendaraan">Nomor Kendaraan:</label>
                                <input type="text" value="{{$antrian->nomor_kendaraan}}" name="nomor_kendaraan" id="nomor_kendaraan" class="form-control" required>
                            </div>    
                            <div class="form-group">
                                <label for="nama_pengemudi">Nama Pengemudi:</label>
                                <input type="text" name="nama_pengemudi" value="{{$antrian->nama_pengemudi}}" id="nama_pengemudi" class="form-control" required>
                            </div>                     
                            <div class="form-group">
                                <label for="tanggal_kedatangan">Tanggal kedatangan:</label>
                                <input type="date" value="{{ date('Y-m-d', strtotime($antrian->waktu_kedatangan)) }}" name="tanggal_kedatangan" id="tanggal_kedatangan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="waktu_kedatangan">Waktu kedatangan:</label>
                                <input type="time" value="{{ date('H:i', strtotime($antrian->waktu_kedatangan)) }}" name="waktu_kedatangan" id="waktu_kedatangan" class="form-control" required>
                            </div>              
                            <div class="form-group">
                                <label for="status">Status :</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Menunggu" {{ $antrian->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="Proses" {{ $antrian->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="Selesai" {{ $antrian->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="/antrian" class="btn btn-danger">Batal</a>
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
