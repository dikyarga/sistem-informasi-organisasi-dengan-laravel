
@extends('app')
@section('title')
  Daftar
@endsection
@section('content')
<form method="POST" action="/auth/register">
    {!! csrf_field() !!}
    <div class="form-group">
      <label for="inputName" class="col-md-2 control-label"><i class="material-icons pull-right">face</i></label>

      <div class="col-md-9">
        <input class="form-control" value="{{ old('name') }}" id="inputEmail" placeholder="Nama" type="text" name="name">
      </div>
    </div>
    <div class="form-group">
      <label  class="col-md-2 control-label"><i class="material-icons pull-right">account_box</i></label>
      <div class="col-md-9">
      <input required="required" placeholder="Username" type="text" value="{{ old('username') }}" name = "username" class="form-control" />
    </div>
    </div>

    <div class="form-group">
      <label for="inputEmail" class="col-md-2 control-label"><i class="material-icons pull-right">email</i></label>

      <div class="col-md-9">
        <input class="form-control" id="inputEmail" value="{{ old('email') }}" placeholder="Email" type="email" name="email">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-md-2 control-label"><i class="material-icons pull-right">lock</i></label>

      <div class="col-md-9">
        <input class="form-control" id="inputPassword" placeholder="Kata Sandi" type="password" name="password">

        <!--
        <div class="checkbox">
          <label>
            <input type="checkbox"> Checkbox
          </label>
          <label>
            <input type="checkbox" disabled> Disabled Checkbox
          </label>
        </div>
        <br>

        <div class="togglebutton">
          <label>
            <input type="checkbox" checked> Toggle button
          </label>
        </div>
        -->
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-md-2 control-label"><i class="material-icons pull-right">lock_open</i></label>

      <div class="col-md-9">
        <input class="form-control" id="inputPassword" placeholder="Konfirmasi Kata Sandi" type="password" name="password_confirmation">


      </div>
    </div>

    <div class="form-group">
      <div class="col-md-8 col-md-offset-2">
          <button type="submit" class="btn btn-primary">Daftar</button>
          <button type="button" class="btn btn-default">Batal</button>
      </div>
    </div>

</form>

@endsection
