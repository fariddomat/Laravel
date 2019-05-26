@extends('layouts.app')

@section('content')

@if (count($errors)>0)
    <ul class="list-group">
        @foreach ($errors->all() as $error)
            <li class="list-group-item text-danger">
                {{$error}}
            </li>
        @endforeach
    </ul>
@endif
    <div class="panel panel-default">
        <div class="panel-heading">
            Edit a Post
        </div>

        <div class="panel-body">
        <form action="{{route('post.update',['id'=>$post->id])}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                  <label for="title">Title</label>
                <input type="text" name="title"  class="form-control" placeholder="title" value="{{$post->title}}">
                </div>

                <div class="form-group">
                        <label for="featured">Featured image</label>
                        <input type="file" name="featured"  class="form-control">
                </div>

                <div class="form-group">
                    <label for="category">Select a Category</label>
                    <select name="category_id" id="category" class="form-control">
                        @foreach ($categories as $category)
                    <option value="{{$category->id}}"
                        @if ($post->category->id ==$category->id)
                            selected
                        @endif
                        >{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                        <label for="tags">Select Tags:</label>
                        @foreach ($tags as $tag)
                        <div class="form-check">
                            <label class="form-check-label">
                            <input name="tags[]" type="checkbox" class="form-check-input" value="{{$tag->id}}" 
                            @foreach ($post->tags as $t)
                                @if ($tag->id ==$t->id)
                                    checked    
                                @endif
                            @endforeach
                            >
                              {{$tag->tag}}
                            </label>
                          </div>
                        @endforeach
                    </div>
                    
                
                <div class="form-group">
                        <label for="content">Content</label>
                <textarea name="content"  id="summernote" cols="5" rows="5" class="form-control">{{$post->content}}</textarea>
                </div>
                <div class="form-group">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Update Post</button>
                    </div>
                </div>
            </form>

        </div>


    </div>

@endsection


@section('styles')
    <!-- include summernote css/js -->
<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
@endsection

@section('scripts')
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
<script>
$(document).ready(function() {
  $('#summernote').summernote();
});
</script>
@endsection