@extends('layouts.app')

@section('content')


@include('admin.includes.error')

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit user profile
        </div>

        <div class="panel-body">
        <form action="{{route('user.profile.update')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                  <label for="name">User</label>
                <input type="text" name="name"  class="form-control" placeholder="name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input  value="{{$user->email}}" type="email" name="email"  class="form-control" placeholder="email" >
                </div>
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" name="password"  class="form-control"  >
                </div>
                <div class="form-group">
                    <label for="avatar">Upload new avatar</label>
                    <input type="file" name="avatar"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook profile</label>
                    <input value="{{$user->profile->facebook}}" type="text" name="facebook"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="youtube">Youtube profile</label>
                    <input value="{{$user->profile->youtube}}" type="text" name="youtube"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="about">About you</label>
                    <textarea name="about" cols="6" ros="6" class="form-control">{{$user->profile->about}}</textarea>
                </div>


                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </div>
                </div>
            </form>

        </div>


    </div>

@endsection