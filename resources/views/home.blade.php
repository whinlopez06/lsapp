@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Welcome to Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <a href="/posts/create" class="btn btn-primary mb-3">Create Post</a>
                    <h3 class="mb-2">Your Blog Posts</h3>
                    <!--You are logged in!-->
                    
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td><a href="/posts/{{ $post->id }}/edit" class="btn btn-light">Edit</a></td>
                                    <td>
                                        <form method="POST" action="/posts/{{$post->id}}">
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
