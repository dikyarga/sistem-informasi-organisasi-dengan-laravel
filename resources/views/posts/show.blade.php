@extends('app')
@section('title')
  @if($post)
    {{ $post->title }}
    @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
      <a href="{{ url('edit/'.$post->slug)}}"><button class="btn" style="float: right">Edit Post</button></a>
    @endif
  @else
    Halaman tidak ditemukan
  @endif
@endsection
@section('title-meta')
<p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} oleh <a href="{{ url('/user/'.App\User::find($post->author_id)->username)}}">{{ $post->author->name }}</a></p>
@endsection
@section('content')
@if($post)
  <div>
    {!! $post->body !!}
  </div>
  <div>
    <h2>Tinggalkan komentar</h2>
  </div>
  @if(Auth::guest())
    <p>Masuk dulu untuk berkomentar</p>
  @else
    <div class="panel-body">
      <form method="post" action="/comment/add">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="on_post" value="{{ $post->id }}">
        <input type="hidden" name="slug" value="{{ $post->slug }}">
        <div class="form-group">
          <textarea required="required" placeholder="Tulis apapun yg kamu pikirkan" name = "body" class="form-control"></textarea>
        </div>
        <input type="submit" name='post_comment' class="btn btn-success" value = "Posting"/>
      </form>
    </div>
  @endif
  <div>
    @if($comments)
    <ul style="list-style: none; padding: 0">
      @foreach($comments as $comment)
        <li class="panel-body">
          <div class="list-group">
            <div class="list-group-item">
              <h3> <a href="{{ url('/user/'.App\User::find($comment->from_user)->username)}}"> {{ $comment->author->name }} </a></h3>
                <p>{{ $comment->created_at->diffForHumans() }}</p>
            </div>
            <div class="list-group-item">
              <blockquote>
                <p>{{ $comment->body }}</p>
              </blockquote>
            </div>
          </div>
        </li>
      @endforeach
    </ul>
    @endif
  </div>
@else
404 error
@endif
@endsection
