@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <h3 class="card-title">Edit Produk form</h3>

                <form class="forms-sample" method="post" action="/produk/{{ $produks->id_produk }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group col-md-6 mt-3 mb-3">
                        <label for="nama_kategori">Nama Kategori</label>
                        <select class="form-control" name="id_kategori">
                            <option value="">Pilih Kategori</option>
                            @foreach ($kategori_produks as $kategori)
                                <option value="{{ $kategori->id_kategori }}"
                                    {{ $kategori->id_kategori == $produks->id_kategori ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('nama_kategori')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 mt-3 mb-3">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk"
                            value="{{ old('nama_produk', $produks->nama_produk) }}">
                        @error('nama_produk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>


                    <div class="form-group col-md-6 mt-3 mb-3">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" name="harga"
                            value="{{ old('harga', $produks->harga) }}">
                        @error('harga')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 mt-3 mb-3">
                        <label for="stok">Stok</label>
                        <input type="number" class="form-control" name="stok"
                            value="{{ old('stok', $produks->stok) }}">
                        @error('stok')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 mt-3 mb-3">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi">{{ old('deskripsi', $produks->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6 mt-3 mb-3">
                        <label for="gambar_produk">URL Gambar Produk</label>
                        <input type="text" class="form-control" name="gambar_produk"
                            value="{{ old('gambar_produk', $produks->gambar_produk) }}">
                        @error('gambar_produk')
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
