@extends('layouts.app')

@section('content')


@include('admin.includes.error')

    <div class="panel panel-default">
        <div class="panel-heading">
            Create a new category
        </div>

        <div class="panel-body">
        <form action="{{route('category.store')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name"  class="form-control" placeholder="name" >
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