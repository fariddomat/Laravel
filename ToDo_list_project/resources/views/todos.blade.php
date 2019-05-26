@extends('layout')

@section('content')

<div class="row">
    <div class="col-lg-6 col-lg-offset-3 ">
        <form method="POST" action="/create/todo">
            {{csrf_field()}}
            <input type="text" name="todo" class="form-control input-lg" placeholder="Create a new Todo">
        </form>
    </div>
</div>
<hr>
    @foreach ($todos as $todo)
        {{$todo->todo}}
<a href="/todo/delete/{{$todo->id}}" class="btn btn-danger btn-xs"> x </a>

<a href="/todo/update/{{$todo->id}}" class="btn btn-info btn-xs"> update </a>

@if (!$todo->completed)
<a href="/todo/completed/{{$todo->id}}" class="btn btn-success btn-xs"> completed </a>
@endif
        <hr>
    @endforeach 

@endsection
                    
