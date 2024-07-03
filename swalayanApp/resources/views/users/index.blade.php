@extends('layouts.main')
@section('title', 'Pegawai')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Pegawai</h3>

                        @if (session()->has('pesan'))
                            <div class="alert alert-success mt-3" role="alert">
                                {{ session('pesan') }}
                            </div>
                        @endif

                        <div class="row table-responsive">

                            @if (auth()->user()->isAdmin == 1)
                                <a href="/pegawai/create" class="btn btn-primary btn-sm"><span data-feather="plus-circle">
                                    </span>Tambahkan Pegawai</a>
                            @endif


                            <table class="table table-striped">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    @can('admin')
                                        <th>Action</th>
                                    @endcan
                                </tr>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        @can('admin')
                                            <td>
                                                <a href="/pegawai/{{ $user->id }}/edit" class="btn btn-warning btn-sm">
                                                    <span data-feather="edit"></span> Edit</a>

                                                <form action="/pegawai/{{ $user->id }}" method="post" class="d-inline">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure want to delete this data ?')">
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
    {{ $users->links() }}
@endsection
