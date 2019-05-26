@extends('layout')

@section('content')
    <h1 class='title'>{{ $project->title}}</h1>

    

    <div class="content " style="margin:0">{{$project->description}}</div>
    @can('update',$project)
    
        <p style="margin-bottom: 25px">
        <a href="/projects/{{$project->id}}/edit" class="button is-link">Edit</a>
        </p>

    @endcan
    
    <ul >
    @if($project->tasks->count())
    	<div class="box">
	    	@foreach($project->tasks as $task)
	    		<li>
                    <form method="POST" action="/completed-tasks/{{$task->id}}">
                        <!--
                        @method('PATCH')
                        -->
                        @if($task->completed)
                            @method('DELETE')
                        @endif

                        @csrf
                        <label class="checkbox {{ $task->completed ? 'is-complete' : ''}}" for="completed">
                            <input type="checkbox" name="completed" onchange="this.form.submit()" {{ $task->completed ? 'checked' : ''}}>
                            {{ $task->description }}
                        </label>

                    </form>


                </li>
	    	@endforeach
   	 	</div>
    @endif
    </ul>

<!-- Add a new Task -->
<form method="POST" action="/projects/{{$project->id}}/tasks" class="box" style="margin-top: 25px">
    @csrf
    <label class="label" for="description">New Task</label>
    <div class="control">
        <input type="text" class="input" name="description" placeholder="New Task" required>
    </div>
    <div class="field" style="margin-top: 5px">
        <div class="control">
            <button type="submit" class="button is-link">Add Task</button>
        </div>
    </div>

    @include('errors')
</form>


@endsection
