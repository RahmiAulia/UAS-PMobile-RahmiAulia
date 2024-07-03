@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <h3 class="card-title">Kategori Produk form</h>

                    <form class="forms-sample" method="post" action="/kategori-produk/{{ $kategori_produks->id_kategori }}">
                        @method('PUT')
                        @csrf
                    
                    
                        <div class="form-group col-md-6 mt-3 mb-3">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="nama_kategori" class="form-control" name="nama_kategori" 
                            value="{{ old('nama_kategori', $kategori_produks->nama_kategori) }}">
                            @error('nama_kategori')
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
