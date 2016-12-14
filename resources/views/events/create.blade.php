@extends('app')

@section('title')
  Buat acara baru
@endsection

@section('content')


  {!! Form::open(['action'=>'EventController@store']) !!}
  <table>
  <tr>
    <td>
      {!! Form::label('title', 'Nama Kegiatan') !!}
    </td>
    <td>
      {!! Form::text('title') !!}
    </td>
  </tr>
  <tr>
    <td>
      {!! Form::label('Deskripsi') !!}
    </td>
    <td>
      {!! Form::textarea('description') !!}
    </td>
  </tr>
  <tr>
    <td>
      {!! Form::label('Waktu') !!}
    </td>
    <td>
      {{-- {!! Form::date('tgl', \Carbon\Carbon::now()) !!} --}}
      {{-- <div class="container">
          <div class="row">
              <div class='col-sm-6'>
                  <div class="form-group"> --}}
                      <div class='input-group date' id='datetimepicker1'>
                          <input type='text' class="form-control" name="datetime" id="datetime"/>
                          <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                      </div>
                  {{-- </div>
              </div> --}}
              <script type="text/javascript">
                  $(function () {
                      $('#datetimepicker1').datetimepicker({
                        format: 'MM/DD/YYYY HH:mm',
                      });
                  });
              </script>
          {{-- </div>
      </div> --}}
    </td>
  </tr>
  <tr>
    <td>
      {!!Form::label('Lokasi')!!}
    </td>
    <td>
      {!! Form::text('location') !!}
    </td>
  </tr>
  <tr>
    <td>
      {!!Form::label('Latitude')!!}
    </td>
    <td>
      {!! Form::text('latitude') !!}
    </td>
  </tr>
  <tr>
    <td>
      {!!Form::label('Longitude')!!}
    </td>
    <td>
      {!! Form::text('longitude') !!}
    </td>
  </tr>
  <tr>
    <td>
      {!!Form::label('Biaya')!!}
    </td>
    <td>
      {!! Form::text('fee') !!}
    </td>
  </tr>
  <tr>
    <td>
      {!!Form::label('Keterangan biaya')!!}
    </td>
    <td>
      {!! Form::text('fee_desc') !!}
    </td>
  </tr>
  <tr>
    <td>
      {!! Form::label('Link acara') !!}
    </td>
    <td>
      {!! Form::text('link') !!}
    </td>
  </tr>
  <tr>
    <td>
      {!! Form::label('Publikasikan') !!}
    </td>
    <td>
      {!! Form::checkbox('active', 1) !!}
    </td>
  </tr>
  <tr>
    <td>

    </td>
    <td>
      {!! Form::submit('Simpan') !!}
    </td>
  </tr>


  </table>
  {!! Form::close() !!}
@endsection
