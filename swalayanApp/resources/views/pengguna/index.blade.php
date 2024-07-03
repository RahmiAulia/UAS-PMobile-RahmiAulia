@extends('layouts.main')
@section('title', 'Dashboard')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title">Pengguna</h3>

                        @if (session()->has('pesan'))
                            <div class="alert alert-success mt-3" role="alert">
                                {{ session('pesan') }}
                            </div>
                        @endif
                        <div class="row table-responsive">

                            {{-- <a href="/car-backend/create" class="btn btn-primary btn-sm"><span data-feather="plus-circle">
                </span> Create Car</a> --}}

                            <table class="table table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Nomor Telepon</th>
                                    @cannot('admin')
                                        <th>Aksi</th>
                                    @endcan

                                </tr>
                                @foreach ($penggunas as $pengguna)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $pengguna->nama }}</td>
                                        <td>{{ $pengguna->email }}</td>
                                        <td>{{ $pengguna->alamat }}</td>
                                        <td>{{ $pengguna->no_telepon }}</td>

                                        @cannot('admin')
                                            <td>

                                                <form action="pengguna/{{ $pengguna->id_pengguna }}" method="post"
                                                    class="d-inline">
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
    {{ $penggunas->links() }}
@endsection
