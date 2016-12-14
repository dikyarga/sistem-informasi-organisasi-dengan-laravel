@extends('app')
@section('title')
  {{ $event->title }}
@endsection

@section('content')
  {{ $event->datetime }}<br/>
  {{ $event->description }}<br>
  {{ $event->location }}<br/>
  <div id="map" style="width: 100%; height: 400px">

  </div>


  <script type="text/javascript">
  function initMap() {
      var uluru = {lat:{{ $event->latitude }}, lng: {{ $event->longitude }}};
      var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 18,
        center: uluru
      });
      var marker = new google.maps.Marker({
        position: uluru,
        map: map
      });
    }
  </script>
  <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCTFX8_D6iq5FiuqUejKrNgKvODASc6f1M&callback=initMap">
  </script>


@endsection
