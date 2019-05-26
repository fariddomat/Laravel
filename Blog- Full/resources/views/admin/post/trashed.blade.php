@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
            <div class="panel-heading">
                    Trashed Posts
                </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Edit</th>
                    <th>Restore</th>
                    <th>Destroy</th>
                </tr>
            </thead>
            <tbody>
                @if ($posts->count()>0)
                    
                
                @foreach ($posts as $post)
                    <tr>
                    <td><img class="img-responsive" src="{{$post->featured}}" alt="" width="90px" height="50px"></td>
                        <td>{{$post->title}}</td>
                        <td>Edit</td>
                    <td><a name="restore" id="restore" class="btn btn-xs btn-success" href="{{route('post.restore',['id'=>$post->id])}}" role="button">Restore</a>
                        </td>

                    
                    <td><a name="delete" id="delete" class="btn btn-xs btn-danger" href="{{route('post.kill',['id'=>$post->id])}}" role="button">Destroy</a>
                    </td>
                    </tr>
                @endforeach

                @else
                <tr><th colspan="5" class="text-center">No trashed posts</th></tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection

