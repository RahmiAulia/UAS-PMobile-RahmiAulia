@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Detail Transaksi</h3>

                        @if (session()->has('pesan'))
                            <div class="alert alert-success mt-3" role="alert">
                                {{ session('pesan') }}
                            </div>
                        @endif
                        <div class="row table-responsive">

                            <table class="table table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengguna</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal Harga</th>


                                </tr>
                                @foreach ($detail_transaksis as $dt)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $dt->transaksi->pengguna->nama }}</td>
                                        <td>{{ $dt->transaksi->tanggal_transaksi }}</td>
                                        <td>{{ $dt->produk->nama_produk }}</td>
                                        <td>{{ $dt->produk->harga }}</td>
                                        <td>{{ $dt->jumlah }}</td>
                                        <td>{{ $dt->subtotal }}</td>

                                        {{-- <td>
                                            <a href="/transaksi/{{ $transaksi->id_transaksi }}/edit"
                                                class="btn btn-warning btn-sm">
                                                <span data-feather="edit"></span>Edit</a>

                                            <form action="transaksi/{{ $transaksi->id_transaksi }}" method="post"
                                                class="d-inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure want to delete this data?')">
                                                    <span data-feather="trash-2"></span>Delete</button>
                                            </form>
                                        </td> --}}

                                    </tr>
                                @endforeach
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- {{ $transaksis->links() }} --}}
@endsection
