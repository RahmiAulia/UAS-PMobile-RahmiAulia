@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
    <!-- partial -->
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Welcome! {{ $userName }}</h3>
                        <h6 class="font-weight-normal mb-0"><span class="text-primary">Hope you have a wonderful day!</span></h6><br>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card card-tale">
                            <div class="card-body">
                                <p class="mb-4">Total Pengguna</p>
                                <p class="fs-30 mb-2">{{ $pengguna }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card card-light-blue">
                            <div class="card-body">
                                <p class="mb-4">Total Produk</p>
                                <p class="fs-30 mb-2">{{ $produk }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card card-light-danger">
                            <div class="card-body">
                                <p class="mb-4">Total Transaksi</p>
                                <p class="fs-30 mb-2">{{ $totalTransaksi }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection
