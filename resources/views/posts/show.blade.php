@extends('layouts.app')


<!--content section-->
@section('content')
    <div class="mb-3">
        <a href="/posts" class="btn btn-info">Go back</a>
    </div>

    <h1>{{ $post->title }}</h1>

    <picture>
        <img style="img-thumbnail" src="/storage/cover_images/{{$post->cover_image}}">
    </picture>
    <br/><br/>
    
     <div>
         <!--!! allows html to be parse-->
         {!! $post->body !!}
    </div>   
    <hr>
    <small>Written on: {{ $post->created_at }} by {{ $post->user->name }}</small>
    <hr>
  
    <!--add view authentication to show only when a user is logged in. guest is for user that is not logged in-->
    @if(!auth::guest())
        <!--Authenticate user to edit and delete only if post belongs to user logged in-->
        @if(auth()->user()->id == $post->user_id)
        <div class="row">
            <div class="col-md-6">
                <a href="/posts/{{$post->id}}/edit" class="btn btn-dark pull-left">Edit</a>
            </div>
            
            <div class="col-md-6 text-right">
                <form method="POST" action="/posts/{{$post->id}}">
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @csrf
                    <!--add laravel spoofing method delete by using method('DELETE')-->
                    @method('DELETE')
                </form>
            </div>
        </div>
        @endif

    @endif

@endsection