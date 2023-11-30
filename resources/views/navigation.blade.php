<div style="display: flex; justify-content: space-evenly; background: gray; padding: 15px;">
    <a href="{{route('pet.create')}}">Add Pet</a>
    <a href="{{ route('pets.findByStatus', ['status' => 'available']) }}">Available</a>
    <a href="{{ route('pets.findByStatus', ['status' => 'pending']) }}">Pending</a>
    <a href="{{ route('pets.findByStatus', ['status' => 'sold']) }}">Sold</a>
</div>