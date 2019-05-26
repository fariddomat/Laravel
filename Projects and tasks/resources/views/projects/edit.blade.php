@extends('layout')

@section('content')
    <h1 class="title">Edit project</h1>
    <form method="POST" action="/projects/{{ $project->id }}" style="margin-bottom:10px;"> 
        @method('PATCH')
        @csrf
        <div class="field">
            <label class="label" for="title">Title</label>
            <div class="control">
                <input type="text" class="input" name="title" placeholer="Title" value="{{ $project->title }}">
            </div>
        </div>

        <div class="field">
            <label class="label" for="description">description</label>
            <div class="control">
                <textarea class="input" name="description" placeholer="Description">{{ $project->description }}</textarea>
            </div>
        </div>
        
        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Update Project</button>
            </div>
        </div>
    </form>
    @include ('errors')

    <form method="POST" action="/projects/{{ $project->id }}">  
    @method('DELETE')
    @csrf
        <div class="field">
            <div class="control">
                <button type="submit" class="button" >Delete</button>
            </div>
        </div>
    </form>
@endsection