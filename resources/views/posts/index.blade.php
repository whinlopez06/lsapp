<!--extends('layouts.layoutmaster')*/-->
@extends('layouts.app')

<!--content section-->
@section('content')

    <div class="text-right">
        <a class="btn btn-primary" href="/posts/create">Add New</a>
    </div>

    <h1>Post</h1>

    @if(count($posts))

        @foreach($posts as $post)
            <div class="card mb-3 p-3"> 

                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <picture>
                            <img style="img-thumbnail" src="/storage/cover_images/{{$post->cover_image}}">
                        </picture>
                    </div>

                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/posts/{{$post->id}}">{{ $post->title}}</a></h3>
                        <small>Written on : {{ $post->created_at }} by {{ $post->user->name}}</small>
                    </div>
                </div>

            </div>
        @endforeach 

        <!--pagination-->
        {{ $posts->links() }}
    @else    
        <p>No posts found.</p>
    @endif

@endsection