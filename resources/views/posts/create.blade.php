@extends('layouts.app')

<!--content section-->
@section('content')
    <h1>Create Post</h1>

    <!--add endtype multipart/data to the form to enable file upload-->
    <form method="POST" action="/posts" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" placeholder="Enter title" value="">
        </div>

        <div class="form-group">
            <label for="body">Body:</label>
            <textarea id="article-ckeditor" class="form-control" name="body" placeholder="Enter Body"></textarea>
        </div>
        
        <div class="form-group">
            <input type="file" name="cover_image">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

@endsection