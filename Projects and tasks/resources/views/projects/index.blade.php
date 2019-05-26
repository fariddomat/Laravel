@extends('layout')

@section('content')

<div class="content" style="">
<h1>Project</h1>
<a name="create" id="" class="button is-link" href="/projects/create" role="button">create new Project</a>
    @if($projects->count())
        <ul>
            @foreach($projects as $project)
                <div class="box">
                    <li>
                        <a href="/projects/{{$project->id}}">
                        {{$project->title}}
                        </a>
                    </li>
                </div>
             @endforeach

            @if(session('message'))
                <p> {{session('message')}} </p>
            @endif
        </ul>
    @endif
</div>



@endsection
