@extends('app')
@section('title')
{{$title}}
@endsection
@section('content')



  <a href="{{ url('/user/add-user') }}" class="btn btn-info"><i class="material-icons">add</i> Tambah User</a>

  <table class="table table-striped table-hover ">
    <thead>
    <tr>
      <th>ID</th>
      <th>Nama</th>
      <th>Username</th>
      <th>Email</th>
      <th>Role</th>
      <th>Aksi</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
    <tr>

      <td>{{$user->id}}</td>
      <td>{{$user->name}}</td>
      <td>{{$user->username}}</td>
      <td>{{$user->email}}</td>
      <td>{{$user->role}}</td>
      <td><a href="{{ url('/user/delete/'.$user->id) }}"><i class="material-icons">delete</i>Delete</a>  <a href="{{ url('/user/edit/'.$user->id) }}"><i class="material-icons">mode edit</i>Edit</a> </td>
    </tr>
    @endforeach

    </tbody>
  </table>
  <center>{!! $users->render() !!}</center>






@endsection
