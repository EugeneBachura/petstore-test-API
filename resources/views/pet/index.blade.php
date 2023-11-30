@extends('app')

@section('content')
    <h1>Pets with status: {{ $status }}</h1>
    @if(count($pets) > 0)
    <div>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($pets as $pet)
                    <tr>
                        <td>{{ $pet['id'] }}</td>
                        <td>{{ $pet['name'] ?? 'No name specified' }}</td>
                        <td>
                            <a href="{{route('pet.show', $pet['id'])}}">Show</a><br>
                            <a href="{{route('pet.edit', $pet['id'])}}">Edit</a><br>
                            <form action="{{route('pet.destroy' , $pet['id'])}}" method="POST" onsubmit="return confirm('Are you sure you want to remove this pet?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
        <p>No pets found.</p>
    @endif
    Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
@endsection