@extends('layouts.main')
    
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
          <h4 class="card-title">Edit Data Pegawai</h4>
          

                  <p class="card-description">Edit informasi pegawai</p>

                  <form class="forms-sample" method="POST" action="/pegawai/{{$users->id}}">
                    @method('PUT')
                    @csrf
                    <div class="form-group col-md-6">
                      <label for="name">Nama</label>
                      <input type="text" class="form-control" @error('name') is-invalid @enderror name="name" value="{{old('name', $users->name)}}">
                      @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" @error('email') is-invalid @enderror name="email" value="{{ old('email', $users->email) }}">
                        @error('email')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" @error('password') is-invalid @enderror name="password" value="{{ old('password', $users->password) }}">
                        @error('password')
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


