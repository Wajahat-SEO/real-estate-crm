@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Block</h2>
    
    <form action="{{ route('blocks.update', $block->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Block Name</label>
            <input type="text" name="name" class="form-control" value="{{ $block->name }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control">{{ $block->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="total_plots">Total Plots</label>
            <input type="number" name="total_plots" class="form-control" value="{{ $block->total_plots }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Block</button>
        <a href="{{ route('blocks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
