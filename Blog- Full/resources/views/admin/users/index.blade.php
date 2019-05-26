@extends('layouts.app')

@section('content')
    
    <div class="panel panel-default">
        <div class="panel-heading">
            Users
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @if($users->count()>0)
                    @foreach ($users as $user)
                        <tr>
                        <td>
                            <img src="{{asset($user->profile->avatar)}}" alt="" width="60px" height="60px" style="border-radius: 50%;">
                        </td>
                        <td>
                            {{$user->name}}
                        </td>
                        <td>
                            @if ($user->admin)
                            <a class="btn btn-xs btn-danger" href="{{route('user.not_admin',['id'=>$user->id])}}" role="button">Remove admin role</a>   
                            @else
                                <a class="btn btn-xs btn-success" href="{{route('user.admin',['id'=>$user->id])}}" role="button">Make admin</a>      
                            @endif
                        </td>
                        <td>
                            @if (Auth::id()!= $user->id) 
                            <a class="btn btn-xs btn-danger" href="{{route('user.delete',['id'=>$user->id])}}" role="button">Delete</a> 
                            @else
                            You can't delete your self
                            @endif
                        </td>
                        </tr>
                    @endforeach
                    @else
                    <tr><th colspan="5" class="text-center">No Users</th></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection

