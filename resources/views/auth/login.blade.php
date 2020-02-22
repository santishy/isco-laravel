@extends('layouts.header')
@include('menus.main')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card border-0 shadow-sm my-4">
            <div class="card-header">
              <h3 style="margin:0px">Login</h3>
            </div>
            <div class="card-body">
              <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group row">
                      <label for="email" class="col-sm-4 col-form-label text-md-right">Correo</label>
                      <div class="col-md-6">
                          <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                          @if ($errors->has('email'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group row">
                      <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label>
                      <div class="col-md-6">
                          <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                          @if ($errors->has('password'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary btn-block" name="button">Ingresar</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
