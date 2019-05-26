@extends('layouts.app')

@section('content')


@include('admin.includes.error')

    <div class="panel panel-default">
        <div class="panel-heading">
            Create a new User
        </div>

        <div class="panel-body">
        <form action="{{route('user.store')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                  <label for="name">User</label>
                  <input type="text" name="name"  class="form-control" placeholder="name" >
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email"  class="form-control" placeholder="email" >
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </div>
            </form>

        </div>


    </div>

@endsection