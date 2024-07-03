@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <h3 class="card-title">Kategori Produk</h3>

                <form class="forms-sample" method="post" action="/kategori-produk">
                    @csrf
                    <div class="form-group row">
                        <label for="nama_kategori" class="col-sm-2 col-form-label">Nama Kategori</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" @error('nama_kategori') is-invalid @enderror
                                name="nama_kategori" value="{{ old('nama_kategori') }}"
                                placeholder="masukkan nama kategori">
                            @error('nama_kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row justify-content-end">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw mr-2">Submit</button>
                            <button class="btn btn-secondary btn-rounded btn-fw">Cancel</button>
                        </div>
                    </div>


            </div>
        </div>
    </div>
@endsection
