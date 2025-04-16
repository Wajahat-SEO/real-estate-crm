@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Plots List</h2>
    <a href="{{ route('plots.create') }}" class="btn btn-primary">Add New Plot</a>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Block</th>
                <th>Plot Number</th>
                <th>Size</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($plots as $plot)
            <tr>
                <td>{{ $plot->id }}</td>
                <td>{{ $plot->block->name }}</td> <!-- Access block name -->
                <td>{{ $plot->plot_number }}</td>
                <p><strong>Total Price:</strong> Rs. {{ number_format($plot->total_price) }}</p>
                <td>{{ $plot->size }}</td>
                <td>{{ $plot->status }}</td>
                <td>
                    <a href="{{ route('plots.edit', $plot->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('plots.destroy', $plot->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
