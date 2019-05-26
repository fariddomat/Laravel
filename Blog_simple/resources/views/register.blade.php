@extends('master')


@section('content')
<div class="col-md-8">
    <h3>Create a new user !!!</h3>

    <form method="post" action="/register">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="">
     </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelpId" placeholder="">
      
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="">
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
    
</div>

@stop