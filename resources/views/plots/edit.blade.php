@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Plot</h2>
    <form action="{{ route('plots.update', $plot->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="block_id">Block</label>
                    <select name="block_id" class="form-control">
                        @foreach($blocks as $block)
                            <option value="{{ $block->id }}" {{ $plot->block_id == $block->id ? 'selected' : '' }}>{{ $block->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="plot_number">Plot Number</label>
                    <input type="text" name="plot_number" class="form-control" value="{{ $plot->plot_number }}" required>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="total_price" class="block text-gray-700 font-bold mb-2">Total Price</label>
                    <input type="number" name="total_price" id="total_price" class="form-control" value="{{ $plot->total_price }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="size">Size</label>
                    <input type="text" name="size" class="form-control" value="{{ $plot->size }}" required>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $plot->status == true ? 'selected' : '' }}>Available</option>
                    <option value="0" {{ $plot->status == false ? 'selected' : '' }}>Sold</option>
                </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Plot</button>
    </form>
</div>
@endsection
