@extends('app')
@section('title')
Pengaturan akun mu
@endsection
@section('content')
<form method="post" action='{{ url("/update/user/settings") }}'>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="user_id" value="{{ $user->id }}{{ old('user_id') }}">
  <div class="form-group">
    <label  class="col-md-2 control-label">Nama</label>
    <div class="col-md-10">
    <input required="required" placeholder="Nama" type="text" name = "name" class="form-control" value="@if(!old('name')){{$user->name}}@endif{{ old('user') }}"/>
  </div>
  </div>
  <div class="form-group">
    <label  class="col-md-2 control-label">Email</label>
    <div class="col-md-10">
      <input required="required" placeholder="Email" type="email" name = "email" class="form-control" value="@if(!old('email')){{$user->email}}@endif{{ old('user') }}"/>
    </div>
  </div>

  <div class="form-group">
    <label  class="col-md-2 control-label">Password</label>
    <div class="col-md-10">
      <input placeholder="Password Baru" type="password" name = "password" class="form-control" value=""/>
    </div>
  </div>




  <input type="submit" name='publish' class="btn btn-success" value = "Perbaharui"/>
  <a href="{{ url('/user/delete/'.$user->id) }}" class="btn btn-danger">Hapus</a>
</form>
@endsection
