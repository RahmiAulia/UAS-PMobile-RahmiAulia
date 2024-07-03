@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Kategori Produk</h3>
                        {{-- <p class="card-description">
                    Add class <code>.table-hover</code>
                </p> --}}

                        @if (session()->has('pesan'))
                            <div class="alert alert-success mt-3" role="alert">
                                {{ session('pesan') }}
                            </div>
                        @endif
                        <div class="row table-responsive">

                            @if (auth()->user()->isAdmin == 0)
                                <a href="/kategori-produk/create" class="btn btn-primary btn-sm ml-2 mb-3"><span
                                        data-feather="plus-circle">
                                    </span>Kategori baru</a>
                            @endif



                            <table class="table table-striped" style="margin-bottom: 20px;">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kategori</th>
                                    @cannot('admin')
                                    <th>Aksi</th>
                                    @endcan

                                </tr>
                                @foreach ($kategori_produks as $kategori)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kategori->nama_kategori }}</td>

                                        @cannot('admin')
                                        <td>
                                            <a href="/kategori-produk/{{ $kategori->id_kategori }}/edit"
                                                class="btn btn-warning btn-sm">
                                                <span data-feather="edit"></span> Edit</a>

                                            <form action="kategori-produk/{{ $kategori->id_kategori }}" method="post"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure want to delete this data?')">
                                                    <span data-feather="trash-2"></span> Delete</button>
                                            </form>
                                        </td>
                                        @endcan

                                    </tr>
                                @endforeach
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- {{ $kategori_produks->links() }} --}}
@endsection
