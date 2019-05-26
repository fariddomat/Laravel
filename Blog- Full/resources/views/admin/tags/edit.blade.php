@extends('layouts.app')

@section('content')

@include('admin.includes.error')

    <div class="panel panel-default">
        <div class="panel-heading">
            Update Tag
        </div>

        <div class="panel-body">
        <form action="{{route('tag.update',['id'=>$tag->id])}}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                  <label for="tag">Tag</label>
                <input value="{{$tag->tag}}" type="text" name="tag"  class="form-control" placeholder="tag" >
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Store Tag</button>
                    </div>
                </div>
            </form>

        </div>


    </div>

@endsection