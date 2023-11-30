@extends('app')

@section('title')
    Add Pet
@endsection

@section('content')
    <h1>Create Pet</h1>
    <form action="{{ route('pet.store') }}" method="POST" id="addPetForm" enctype="multipart/form-data">
        @csrf
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"><br><br>

        <label for="photo">Photos:</label>
        <input type="file" id="photos" name="photos[]" multiple><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status">
            <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="sold" {{ old('status') == 'sold' ? 'selected' : '' }}>Sold</option>
        </select><br><br>

        <input type="submit" form="addPetForm" value="Add Pet">
    </form>
@endsection