@extends('app')
@section('title')
{{ $user->name }}
@endsection

@section('content')
<div>
  <ul class="list-group">
    <li class="list-group-item">
      Bergabung pada {{$user->created_at->diffForHumans() }}
    </li>
    <li class="list-group-item panel-body">
      <table class="table-padding">
        <style>
          .table-padding td{
            padding: 3px 8px;
          }
        </style>
        <tr>
          <td>Jumlah Postingan</td>
          <td> {{$posts_count}}</td>
          @if($author && $posts_count)
          <td><a href="{{ url('/my-all-posts')}}">Lihat Semua</a></td>
          @endif
        </tr>
        <tr>
          <td>Postingan yang telah di Publikasikan</td>
          <td>{{$posts_active_count}}</td>
          @if($posts_active_count)
          <td><a href="{{ url('/user/'.$user->username.'/posts')}}">Lihat Semua</a></td>
          @endif
        </tr>
        <tr>
          <td>Posts in Draft </td>
          <td>{{$posts_draft_count}}</td>
          @if($author && $posts_draft_count)
          <td><a href="{{ url('my-drafts')}}">Lihat Semua</a></td>
          @endif
        </tr>
      </table>
    </li>
    <li class="list-group-item">
      Total Comments {{$comments_count}}
    </li>
  </ul>
</div>
<div class="panel panel-default">
  <div class="panel-heading"><h3>Posting Terbaru</h3></div>
  <div class="panel-body">
    @if(!empty($latest_posts[0]))
    @foreach($latest_posts as $latest_post)
      <p>
        <strong><a href="{{ url('/'.$latest_post->slug) }}">{{ $latest_post->title }}</a></strong>
        <span class="well-sm">On {{ $latest_post->created_at->diffForHumans()  }}</span>
      </p>
    @endforeach
    @else
    <p>Kamu belum pernah nulis sampai sekarang, ayo tulis sesuatu!</p>
    @endif
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading"><h3>Komentar Terbaru</h3></div>
  <div class="list-group">
    @if(!empty($latest_comments[0]))
    @foreach($latest_comments as $latest_comment)
      <div class="list-group-item">
        <p>{{ $latest_comment->body }}</p>
        <p>On {{ $latest_comment->created_at->diffForHumans()  }}</p>
        <p>On post <a href="{{ url('/'.$latest_comment->post->slug) }}">{{ $latest_comment->post->title }}</a></p>
      </div>
    @endforeach
    @else
    <div class="list-group-item">
      <p>Kamu belum pernah berkomentar, ayo keluarkan unek-unek mu.</p>
    </div>
    @endif
  </div>
</div>
@endsection
