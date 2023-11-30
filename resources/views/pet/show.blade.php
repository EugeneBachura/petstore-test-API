@extends('app')

@section('content')
    <h1>Pet Details</h1>
    <p>Name: {{ $pet['name'] ?? 'No name specified'}}</p>
    <p>Status: {{ $pet['status'] ?? 'No status' }}</p>
    @isset($pet['photoUrls'])
        <p>Photo:<br>
            @foreach ($pet['photoUrls'] as $photo)
                <img src="{{$photo}}" alt="" style="max-width: 200px">
            @endforeach
        <br></p>
    @endisset
@endsection