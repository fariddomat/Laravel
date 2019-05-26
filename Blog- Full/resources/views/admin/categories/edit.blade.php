@extends('layouts.app')

@section('content')

@include('admin.includes.error')

    <div class="panel panel-default">
        <div class="panel-heading">
            Update category
        </div>

        <div class="panel-body">
        <form action="{{route('category.update',['id'=>$category->id])}}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                  <label for="name">Name</label>
                <input value="{{$category->name}}" type="text" name="name"  class="form-control" placeholder="name" >
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Store Category</button>
                    </div>
                </div>
            </form>

        </div>


    </div>

@endsection