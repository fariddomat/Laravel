@extends('master')


@section('content')
<div class="col-md-8">
    <h3>Login Page!!!</h3>

    <form method="post" action="/login">
    {{ csrf_field() }}
    
    
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="">
      
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Login</button>
    </div>
    </form>
    
    @foreach ($errors->all() as $error)
        {{ $error }}<br>
    @endforeach
</div>

@stop