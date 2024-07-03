@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <h3 class="card-title">Produk</h3>

                <form class="forms-sample" method="post" action="/produk">
                    @csrf
                    <div class="form-group col-md-6 mt-3 mb-3">
                        <label for="nama_kategori">Nama Kategori</label>
                        <select class="form-control" name="id_kategori">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori_produks as $kategori)
                                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 mt-3 mb-3">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" value="{{ old('nama_produk') }}">
                        @error('nama_produk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 mt-3 mb-3">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga" value="{{ old('harga') }}">
                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 mt-3 mb-3">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" name="stok" value="{{ old('stok') }}">
                        @error('stok')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 mt-3 mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 mt-3 mb-3">
                        <label for="gambar_produk">URL Gambar Produk</label>
                        <input type="text" class="form-control" name="gambar_produk" value="{{ old('gambar_produk') }}">
                        @error('gambar_produk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="form-group row justify-content-end">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary btn-rounded btn-fw mr-2">Submit</button>
                            <button class="btn btn-secondary btn-rounded btn-fw">Cancel</button>
                        </div>
                    </div>


            </div>
        </div>
    </div>
@endsection
