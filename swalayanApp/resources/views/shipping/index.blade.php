@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Status Pengiriman</h3>

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
                                    <th>Biaya Pengiriman</th>
                                    <th>Status Pengiriman</th>
                                    

                                </tr>
                                @foreach ($shippings as $pengiriman)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pengiriman->transaksi->pengguna->nama }}</td>
                                        <td>{{ $pengiriman->biaya }}</td>
                                        {{-- <td>{{ $pengiriman->status }}</td> --}}
                                        <td class="font-weight-medium">
                                            <div class="badge badge-success">{{ $pengiriman->status }}</div>
                                        </td>

                                        {{-- <td>

                                            <form action="/pengiriman/{{ $pengiriman->id_pengiriman }}" method="post"
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
    {{-- {{ $ulasans->links() }} --}}
@endsection
