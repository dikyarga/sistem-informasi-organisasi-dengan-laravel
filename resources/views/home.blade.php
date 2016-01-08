@extends('app')
@section('title')
{{$title}}
@endsection



@section('content')

@if ( !$posts->count() )
Belum ada postingan, masuk dan tulis sesuatu!
@else
<div class="">
  @foreach( $posts as $post )
  <div class="list-group">
    <div class="list-group-item">
      <h3><a href="{{ url('/'.$post->slug) }}">{{ $post->title }}</a>
        @if(!Auth::guest() && ($post->author_id == Auth::user()->id || Auth::user()->is_admin()))
          @if($post->active == '1')
          <a class="btn-raised" href="{{ url('edit/'.$post->slug)}}"><button class="btn" style="float: right">Sunting Post</button></a>
          @else
          <a href="{{ url('edit/'.$post->slug)}}"><button class="btn" style="float: right">Edit Draft</button></a>
          @endif
        @endif
      </h3>
      <p>{{ $post->created_at->format('M d,Y \a\t h:i a') }} oleh <a href="{{ url('/user/'.App\User::find($post->author_id)->username)}}">{{ $post->author->name }}</a></p>
    </div>
    <div class="list-group-item">
      <article>
        {!! str_limit($post->body, $limit = 1500, $end = '....... <a href='.url("/".$post->slug).'>Lanjutin baca
        </a>') !!}
      </article>
    </div>
  </div>
  @endforeach
  <center>  {!! $posts->render() !!} </center>
</div>
@endif
@endsection
