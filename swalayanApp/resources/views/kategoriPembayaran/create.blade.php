@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <h3 class="card-title">Kategori Pembayaran</h3>

                <form class="forms-sample" method="post" action="/kategori-pembayaran">
                    @csrf
                    <div class="form-group row">
                        <label for="jenis_pembayaran" class="col-sm-2 col-form-label">Jenis Pembayaran</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" @error('jenis_pembayaran') is-invalid @enderror
                                name="jenis_pembayaran" value="{{ old('jenis_pembayaran') }}"
                                placeholder="masukkan jenis kategori">
                            @error('jenis_pembayaran')
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
