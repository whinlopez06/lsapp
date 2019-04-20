
@extends('layouts.app')

@section('content')
    <!--instead of $data array passed it is extract($data) so you can access the key values-->
    <h1>{{ $title }}</h1>
    <p>Here are samples of service offered and person incharge.</p>

    <ul class="list-group">

        @foreach($services as $index => $val)

            <li class="list-group-item"><strong>{{ $val }}</strong> : {{ array_key_exists($index, $employees) ? $employees[$index] : '' }} </li>
        
        @endforeach
    
    </ul>

@endsection