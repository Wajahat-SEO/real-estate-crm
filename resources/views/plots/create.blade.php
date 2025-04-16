@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Plot</h2>
    <form action="{{ route('plots.store') }}" method="POST">
        @csrf
        
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="block_id">Block</label>
                    <select name="block_id" class="form-control">
                        @foreach($blocks as $block)
                            <option value="{{ $block->id }}">{{ $block->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="plot_number">Plot Number</label>
                    <input type="text" name="plot_number" class="form-control" value="{{ old('plot_number') }}" required>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="total_price">Total Price</label>
                    <input type="number" name="total_price" class="form-control" value="{{ old('total_price') }}" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="size">Size</label>
                    <input type="text" name="size" class="form-control" value="{{ old('size') }}" required>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="1">Available</option>
                        <option value="0">Sold</option>
                    </select>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create Plot</button>
    </form>
</div>
@endsection
