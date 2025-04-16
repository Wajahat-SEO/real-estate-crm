@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Plots List</h2>

    <!-- Add New Plot Button -->
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('plots.create') }}" class="btn btn-success">Add New Plot</a>
    </div>

    <!-- Responsive Table -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Block</th>
                    <th>Plot Number</th>
                    <th>Plot Price</th>
                    <th>Size</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plots as $plot)
                <tr>
                    <td>{{ $plot->id }}</td>
                    <td>{{ $plot->block->name }}</td>
                    <td>{{ $plot->plot_number }}</td>
                    <td>Rs. {{ number_format($plot->total_price) }}</td>
                    <td>{{ $plot->size }}</td>
                    <td>
                    
                         <!-- Status with conditional styling -->
                         <span class="badge 
                            @if($plot->status)
                                bg-success  <!-- Available: Green -->
                            @else
                                bg-danger  <!-- Sold: Red -->
                            @endif">
                            @if($plot->status)
                                Available
                            @else
                                Sold
                            @endif 
                        </span>
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('plots.edit', $plot->id) }}" class="btn btn-warning">Edit</a> &nbsp;&nbsp;&nbsp;
                            <form action="{{ route('plots.destroy', $plot->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
