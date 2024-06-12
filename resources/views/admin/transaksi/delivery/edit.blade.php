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

                        <form action="/delivery/update/{{$delivery->id}}" method="post">
                            @csrf
                            @method('PATCH')   
                            <div class="form-group">
                                <label for="no_do">No DO</label>
                                <input type="text" name="no_do" id="no_do" value="{{$delivery->no_do}}" readonly class="form-control" required>
                            </div>             
                            <div class="form-group">
                                <label for="pelanggan_id">Nama Pelanggan:</label>
                                <select name="pelanggan_id" id="pelanggan_id" class="form-control" required >
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach($pelanggan as $s)
                                        <option value="{{ $s->id }}" {{ $delivery->pelanggan_id == $s->id ? 'selected' : '' }}>
                                            {{ $s->nama_pelanggan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jenis_semen">Jenis Semen</label>
                                <select name="jenis_id" id="jenis_id" class="form-control" required>
                                    <option value="">Pilih Jenis Semen</option>
                                    @foreach($jenis as $k)
                                        <option value="{{ $k->id }}" {{ $delivery->jenis_id == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_jenis }}
                                        </option>
                                        @endforeach
                                </select>
                            </div>         
                            <div class="form-group">
                                <label for="tanggal_delivery">Jumlah Semen:</label>
                                <input type="number" value="{{$delivery->jumlah_semen}}" name="jumlah_semen" id="jumlah_semen" class="form-control" required>
                            </div>                     
                            <div class="form-group">
                                <label for="tanggal_pemesanan">Tanggal Pemesanan:</label>
                                <input type="date" value="{{ date('Y-m-d', strtotime($delivery->waktu_pemesanan)) }}" name="tanggal_pemesanan" id="tanggal_pemesanan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="waktu_pemesanan">Waktu Pemesanan:</label>
                                <input type="time" value="{{ date('H:i', strtotime($delivery->waktu_pemesanan)) }}" name="waktu_pemesanan" id="waktu_pemesanan" class="form-control" required>
                            </div>                    
                            
                            <div class="form-group">
                                <label for="status">Status :</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">Pilih Status</option>
                                    <option value="Menunggu" {{ $delivery->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="Proses" {{ $delivery->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                    <option value="Selesai" {{ $delivery->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
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


@endsection
