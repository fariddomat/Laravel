@extends('master')


@section('content')

    <h1 class="page-header">
        World Blog!!
        <small>belong to: <b>FaridDomat</b></small>
    </h1>

      
    <!-- Blog Post -->
    
    <h2>
        <a href="#">{{$post->title}}</a>
    </h2>

    <p class="lead">
        by <a href="index.php">{{$post->user['name']}}</a>
    </p>
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at->toDayDateTimeString() }}
     <strong> Category:</strong>
     <a href="../category/{{$post->category->name}}">
     {{$post->category->name}}
     </a></p>
    <hr>
    @if ($post->url)
      <img class="img-responsive" src="../upload/{{$post->url}}" alt="">
      <hr>  
    @endif
    <p>{{$post->body}}</p>
    <br>

    <div class="comments">
        @foreach ($post->comments as $comment)
            <p class="comment">{{$comment->body}}</p>
        @endforeach
    </div>

    <br>
@if($stop_comment==1)
<h3>Oops!! Comments Are Currently closed !!</h3>
@else
    <form method="POST" action="/posts/{{$post->id}}/store" >
        {{ csrf_field() }}

        
        <div class="form-group">
        <label for="body">Write Something...</label>
        <textarea name="body" id="body" class="form-control"></textarea>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </div>
    </form>
@endif
    <hr>

  
    <!-- Pager -->
    <ul class="pager">
        <li class="previous">
            <a href="#">&larr; Older</a>
        </li>
        <li class="next">
            <a href="#">Newer &rarr;</a>
        </li>
    </ul>

@stop