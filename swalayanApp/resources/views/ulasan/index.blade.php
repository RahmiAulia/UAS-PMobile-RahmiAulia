@extends('layouts.main')
@section('title', 'Ulasan')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Ulasan Pengguna</h3>

                        @if (session()->has('pesan'))
                            <div class="alert alert-success mt-3" role="alert">
                                {{ session('pesan') }}
                            </div>
                        @endif
                        <div class="row table-responsive">

                            <table class="table table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>Produk</th>
                                    <th>Pengguna </th>
                                    <th>Ulasan</th>
                                    <th>Rating</th>
                                    @cannot('admin')
                                        <th>Aksi</th>
                                    @endcan

                                </tr>
                                @foreach ($ulasans as $ulasan)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $ulasan->produk->nama_produk }}</td>
                                        <td>{{ $ulasan->pengguna->nama }}</td>
                                        <td style="overflow-wrap: break-word;">{{ $ulasan->ulasan }}</td>
                                        <td>{{ $ulasan->rating }}</td>

                                        @cannot('admin')
                                            <td>

                                                <form action="ulasan/{{ $ulasan->id_ulasan }}" method="post" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure want to delete this data?')">
                                                        <span data-feather="trash-2"></span>Delete</button>
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
    {{-- {{ $ulasans->links() }} --}}
@endsection
