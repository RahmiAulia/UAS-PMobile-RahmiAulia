@extends('layouts.main')
@section('title', 'Produk')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Produk</h3>

                        @if (session()->has('pesan'))
                            <div class="alert alert-success mt-3" role="alert">
                                {{ session('pesan') }}
                            </div>
                        @endif
                        <div class="row table-responsive">

                            @cannot('admin')
                                <a href="/produk/create" class="btn btn-primary btn-sm mb-3 mr-2"><span
                                        data-feather="plus-circle">
                                    </span>Tambah Produk Baru</a>

                                    {{-- <a href="/produk/add" class="btn btn-primary btn-sm mb-3 mr-2"><span
                                        data-feather="plus-circle">
                                    </span>Tambah Stok Produk</a> --}}
                                @endif



                                <table class="table table-responsive table-striped table-borderless">
                                    <tr>
                                        <th>No</th>
                                        <th>Kategori Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Deksripsi</th>
                                        <th>Gambar Produk</th>
                                        @cannot('admin')
                                            <th>Aksi</th>
                                            @endif

                                        </tr>
                                        @foreach ($produks as $produk)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $produk->kategori->nama_kategori }}</td>
                                                <td>{{ $produk->nama_produk }}</td>
                                                <td>{{ $produk->harga }}</td>
                                                <td>{{ $produk->stok }}</td>
                                                <td>{{ $produk->deskripsi }}</td>
                                                <td><img src="{{ $produk->gambar_produk }}" alt=""></td>


                                                @cannot('admin')
                                                    <td>
                                                        <a href="/produk/{{ $produk->id_produk }}/edit" class="btn btn-warning btn-sm">
                                                            <span data-feather="edit"></span>Edit</a>

                                                        <form action="produk/{{ $produk->id_produk }}" method="post" class="d-inline">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure want to delete this data?')">
                                                                <span data-feather="trash-2"></span>Delete</button>
                                                        </form>
                                                    </td>
                                                @endif

                                            </tr>
                                            @endforeach
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{ $produks->links() }}
            @endsection
