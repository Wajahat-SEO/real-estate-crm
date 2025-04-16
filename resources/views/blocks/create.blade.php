@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Create a New Block</h2>
        <a href="{{ route('blocks.index') }}" class="btn btn-secondary">
            View Blocks List
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('blocks.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Block Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description (Optional)</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label for="total_plots" class="form-label">Total Plots</label>
            <input type="number" class="form-control" id="total_plots" name="total_plots" required min="1">
        </div>

        <button type="submit" class="btn btn-primary">Create Block</button>
    </form>
</div>
@endsection
