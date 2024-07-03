@extends('layouts.main')
    
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin">
          <h4 class="card-title">User form</h4>
          

                  <p class="card-description">Masukkan data pegawai</p>

                  <form class="forms-sample" method="POST" action="/pegawai">
                    @csrf
                    <div class="form-group col-md-6">
                      <label for="name">Nama</label>
                      <input type="text" class="form-control" @error('name') is-invalid @enderror name="name" value="{{old('name')}}" id="name" placeholder="nama">
                      @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                      @enderror
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" @error('email') is-invalid @enderror name="email" value="{{old('email')}}" id="email" placeholder="email">
                        @error('email')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="form-group col-md-6">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" @error('password') is-invalid @enderror name="password" value="{{old('password')}}" id="password" placeholder="password">
                        @error('password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                    </div>

                    {{-- <div class="form-group col-md-6">
                        <label for="status">Status :</label>
                        <select name="status" id="status">
                            @foreach ($enumOptions as $option)
                                <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                    </div> --}}


                    
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-inverse-secondary">Cancel</button>
                  </form>


          
      </div>
    </div>
</div>

@endsection


