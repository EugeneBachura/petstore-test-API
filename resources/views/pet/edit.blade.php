@extends('app')

@section('title')
    Edit Pet
@endsection

@php
    if (!isset($pet['name'])) $pet['name'] = ''; 
@endphp

@section('content')
    <h1>Edit Pet</h1>
    <form action="{{ route('pet.update', $pet['id']) }}" method="POST" id="editPetForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $pet['name']) }}"><br><br>

        <label for="photo">Photo:</label>
        @isset($pet['photoUrls'])
            <br>
            @foreach ($pet['photoUrls'] as $photo)
                <img src="{{$photo}}" alt="" style="max-width: 200px">
            @endforeach
            <br>
        @endisset
        <input type="file" id="photos" name="photos[]" multiple><br><br>
        

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="available" {{ old('status', $pet['status']) == 'available' ? 'selected' : '' }}>Available</option>
            <option value="pending" {{ old('status', $pet['status']) == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="sold" {{ old('status', $pet['status']) == 'sold' ? 'selected' : '' }}>Sold</option>
        </select><br><br>

        <input type="submit" form="editPetForm" value="Edit Pet">
    </form>
@endsection