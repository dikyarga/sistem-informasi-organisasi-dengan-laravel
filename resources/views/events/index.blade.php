@extends('app')
@section('title')
  Event Doscom
@endsection

@section('content')
  @if (!$acara->count())
    Belum ada acara
  @endif
  {{-- {{dd($acara->get())}} --}}
  @foreach($acara as $event)
    <a href="{{ url('/event/'.$event->slug) }}"><h3>{{ $event->title }}</h3></a>
    {{ $event->datetime }}<br/>
  @endforeach
@endsection
