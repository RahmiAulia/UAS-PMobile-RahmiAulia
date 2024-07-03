@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <h3 class="card-title">Edit Jenis Pembayaran form</h>

                    <form class="forms-sample" method="post" action="/kategori-pembayaran/{{ $kategori_pembayarans->id_kategori_pembayaran }}">
                        @method('PUT')
                        @csrf
                        <div class="form-group col-md-6 mt-3 mb-3">
                            <label for="jenis_pembayaran">Jenis Pembayaran</label>
                            <input type="text" class="form-control"
                                @error('jenis_pembayaran') is-invalid_jenis_pembayaran @enderror name="jenis_pembayaran"
                                value="{{ old('jenis_pembayaran', $kategori_pembayarans->jenis_pembayaran) }}">
                            @error('jenis_pembayaran')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary mr-2">Save</button>

                    </form>



            </div>
        </div>
    </div>
@endsection
