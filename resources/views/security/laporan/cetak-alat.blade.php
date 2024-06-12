@extends('admin.layout.master')

@section('title', 'Cetak Laporan Alat')

@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Form Alat</h3>
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

                        <div class="form-group">
                            <label for="alat_id">Alat:</label>
                            <select name="alat_id" id="alat_id" class="form-control" required>
                                <option value="">Pilih Alat</option>
                                @foreach($alat as $s)
                                    <option value="{{ $s->id }}" data-harga="{{ $s->harga_perhari }}">{{ $s->Jenis->nama_jenis }} || {{ $s->merk }} || {{ $s->type }} || {{ $s->harga_perhari }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-12 d-flex justify-content-end">
                            <a href="" onclick="this.href='/laporan-alat-detail/'+ document.getElementById('alat_id').value"
                               target="_blank" class="btn btn-primary me-1 mb-1">Cetak Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
