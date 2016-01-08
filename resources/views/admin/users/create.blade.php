@extends('app')
@section('title')
Tambah User Baru
@endsection
@section('content')


<form action="add-user" method="post">
  <div class="form-group">
    <label class="col-md-2 control-label">Nama</label>
    <div class="col-md-10">
    <input id="name" required="required" placeholder="Nama" type="text" name = "name" class="form-control" />
  </div>
  </div>
  <div class="form-group">
    <label  class="col-md-2 control-label">Username</label>
    <div class="col-md-10">
    <input required="required" placeholder="Username" type="text" name = "username" class="form-control" />
  </div>
  </div>
  <div class="form-group">
    <label  class="col-md-2 control-label">Email</label>
    <div class="col-md-10">
      <input required="required" placeholder="Email" type="email" name = "email" class="form-control" />
    </div>
  </div>
  <div class="form-group">
      <label  class="col-md-2 control-label">Role</label>

      <div class="col-md-10">
        <select name="role" class="form-control">
          <option value="anggota">Anggota</option>
          <option value="pengurus">Pengurus</option>
          <option value="admin">Admin</option>
        </select>
      </div>
    </div>
  <div class="form-group">
    <label  class="col-md-2 control-label">Password</label>
    <div class="col-md-10">
      <input placeholder="Password Baru" type="password" name = "password" class="form-control" />
    </div>
  </div>
  <input type="hidden" name="_token" value="{{ csrf_token() }}">


  <input type="submit" name='save' class="btn btn-success" value = "Tambahkan"/>
</form>
@endsection
