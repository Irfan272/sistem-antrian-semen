@extends('admin.layout.master')

@section('title', 'View Data Pelanggan')

@section('content')
     <!-- page content -->
     <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Form Pelanggan</h3>
                </div>

              
            </div>
            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        
                        <div class="x_content">
                            @foreach ($pelanggan as $e)
                                
                            <form class="" action="/pelanggan/update/{{ $e->id }}" method="post" novalidate>
                                @csrf
                                @method('PATCH')
                                <span class="section">View Data Pelanggan</span>
                              
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nama Pelanggan<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ $e->nama_pelanggan }}" readonly class="@error('nama_pelanggan') parsley-error @enderror readonly form-control" data-validate-length-range="6" data-validate-words="2" name="nama_pelanggan" required="required" />
                                        @error('nama_pelanggan')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div>
                           
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Alamat<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ $e->alamat }}" class="@error('alamat') parsley-error @enderror form-control" readonly data-validate-length-range="6" data-validate-words="2" name="alamat" required="required" />
                                        @error('alamat')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">No Telepon<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ $e->no_telpon }}" class="@error('no_telpon') parsley-error @enderror form-control" readonly data-validate-length-range="6" data-validate-words="2" name="no_telpon" required="required" />
                                        @error('no_telpon')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div>
                                <div class="field item form-group">
                                    <label class="col-form-label col-md-3 col-sm-3  label-align">Email<span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6">
                                        <input value="{{ $e->email }}" class="@error('email') parsley-error @enderror form-control" readonly data-validate-length-range="6" data-validate-words="2" name="email" required="required" />
                                        @error('email')
                                        <ul class="parsley-errors-list filled">
                                            <li class="parsley-required">{{ $message }}</li>
                                        </ul>   
                                        @enderror 
                                    </div>
                                </div>
                                <div class="ln_solid">
                                    <div class="form-group">
                                        <div class="col-md-6 offset-md-3">
                                            {{-- <button type='submit' class="btn btn-primary">Submit</button> --}}
                                            <a href="/pelanggan" class="btn btn-danger">Kembali</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection