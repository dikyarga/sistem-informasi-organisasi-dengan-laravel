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
    <h3>{{ $event->title }}</h3>
    {{ $event->datetime }}<br/>
  @endforeach
@endsection
