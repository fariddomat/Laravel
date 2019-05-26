@extends('layouts.app')

@section('content')


@include('admin.includes.error')

    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Blog Settings
        </div>

        <div class="panel-body">
        <form action="{{route('settings.update')}}" method="POST">
                {{csrf_field()}}
                <div class="form-group">
                  <label for="site_name">Site name</label>
                <input type="text" value="{{$settings->site_name}}" name="site_name"  class="form-control" placeholder="Site name" >
                </div>
                <div class="form-group">
                  <label for="number">Contct number</label>
                  <input type="text"  value="{{$settings->contact_number}}" 
                    class="form-control" name="number" placeholder="">
                </div>
                <div class="form-group">
                    <label for="email">Conteact email</label>
                <input type="email" value="{{$settings->contact_email}}" name="email"  class="form-control" placeholder="email" >
                </div>
                <div class="form-group">
                  <label for="address">Address</label>
                  <input type="text"  value="{{$settings->address}}"
                    class="form-control" name="address" >
                </div>

                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Settings</button>
                    </div>
                </div>
            </form>

        </div>


    </div>

@endsection