@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>

    <form method="POST" action="/posts/{{ $post->id }}" enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" placeholder="Enter title" value="{{ $post->title }}">
        </div>

        <div class="form-group">
            <label for="body">Body:</label>
        <textarea id="article-ckeditor" class="form-control" name="body" placeholder="Enter Body">{!! $post->body !!}</textarea>
        </div>

        <div class="form-group">
            <input type="file" name="cover_image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>

    </form>

@endsection