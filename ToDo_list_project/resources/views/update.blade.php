@extends('layout')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <form method="POST" action="/todo/save/{{$todo->id}}">
            {{csrf_field()}}
        <input type="text" value="{{$todo->todo}}" name="todo" class="form-control input-lg" placeholder="write something">
        </form>
    </div>
</div>

@endsection
                    
