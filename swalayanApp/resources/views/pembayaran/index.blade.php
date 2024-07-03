@extends('layouts.main')
@section('title', 'Pembayaran')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Pembayaran</h3>

                        @if (session()->has('pesan'))
                            <div class="alert alert-success mt-3" role="alert">
                                {{ session('pesan') }}
                            </div>
                        @endif
                        <div class="row table-responsive">
                            <table class="table my-4">
                                <tr>
                                    <th>No</th>
                                    <th>Pengguna </th>
                                    <th>Total Transaksi</th>
                                    <th>Biaya Pengiriman</th>
                                    <th>Total Pembayaran</th>
                                    <th>Kategori Pembayaran</th>
                                    <th>Tanggal Pembayaran</th>
                                </tr>
                                @foreach ($pembayarans as $bayar)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $bayar->shipping && $bayar->shipping->transaksi && $bayar->shipping->transaksi->pengguna ? $bayar->shipping->transaksi->pengguna->nama : 'N/A' }}</td>
                                        <td>{{ $bayar->shipping && $bayar->shipping->transaksi ? $bayar->shipping->transaksi->total_harga : 'N/A' }}</td>
                                        <td>{{ $bayar->shipping ? $bayar->shipping->biaya : 'N/A' }}</td>
                                        <td>{{ $bayar->total_pembayaran }}</td>
                                        <td>{{ $bayar->kategoriPembayaran ? $bayar->kategoriPembayaran->jenis_pembayaran : 'N/A' }}</td>
                                        <td>{{ $bayar->tanggal_pembayaran }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
