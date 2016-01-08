@extends('app')
@section('title')
{{$title}}


@endsection

@section('content')
<h4> Selamat datang - {{Auth::user()->role}} : {{ Auth::user()->name }}!</h4>
@endsection


@section('custom-content')

<div class="col-md-6">
  <div class="panel panel-default">
    <div class="panel-heading"><h3>Postingan Terbaru</h3></div>
    <div class="panel-body">
      <div class="list-group">

        @foreach($posts as $post)
        <div class="list-group-item">
          <div class="row-action-primary">
            <i class="material-icons">folder</i>
          </div>
          <div class="row-content">
            <div class="action-secondary"><i class="material-icons">info</i></div>
            <h4 class="list-group-item-heading"><a href="{{ url('/'.$post->slug) }}">{{$post->title}}</a> </h4>

            <p class="list-group-item-text">{{$post->created_at->diffForHumans()}} oleh <a href="{{ url('/user/'.App\User::find($post->author_id)->username)}}"> {{App\User::find($post->author_id)->username}}</a></p>
          </div>
        </div>


  <div class="list-group-separator"></div>
  @endforeach

</div>
    </div>
  </div>

</div>
<div class="col-md-6">
  <div class="panel panel-default">
    <div class="panel-heading"><h3>Komentar Terbaru</h3></div>
    <div class="panel-body">
      <div class="list-group">
        @foreach($comments as $comment)
        <div class="list-group-item">
          <div class="row-action-primary">
            <i class="material-icons">folder</i>
          </div>
          <div class="row-content">
            <div class="action-secondary"><i class="material-icons">info</i></div>
            <h4> " {{$comment->body}} " </h4>

            <p class="list-group-item-text">{{$comment->created_at->diffForHumans()}} oleh <a href="{{ url('/user/'.App\User::find($comment->from_user)->username)}}"> {{App\User::find($post->author_id)->username}}</a></p>
          </div>
        </div>


  <div class="list-group-separator"></div>
  @endforeach
            </div>
  </div>
</div>
</div>
@endsection
