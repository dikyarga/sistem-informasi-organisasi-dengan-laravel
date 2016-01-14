@extends('app')
@section('title')
Masuk
@endsection
@section('content')



<form method="POST" action="/auth/login">
    {!! csrf_field() !!}
    <div class="form-group">

      <label for="inputEmail" class="col-md-3 control-label"> <i class="material-icons pull-right">account_box</i></label>

      <div class="col-md-7">
                {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username', 'required', 'autofocus', 'id' => 'inputUsername' ]) !!}
      </div>
    </div>

    <div class="form-group">
      <label for="inputPassword" class="col-md-3 control-label"><i class="material-icons pull-right">lock</i></label>

      <div class="col-md-7">
        <input class="form-control" id="inputPassword" placeholder="Password" type="password" name="password">


      </div>
    </div>

    <div class="form-group" style="margin-top: 0;"> <!-- inline style is just to demo custom css to put checkbox below input above -->
      <div class="col-md-offset-3 col-md-8">
        <div class="checkbox">
          <label>
            <input type="checkbox" name="remember"> Tetap masuk
          </label>
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-md-10 col-md-offset-3">
          <button type="submit" class="btn btn-primary">Masuk</button>
          <button type="button" class="btn btn-default">Batal</button>
      </div>
    </div>

</form>
@endsection
