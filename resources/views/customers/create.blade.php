@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Customer</h2>

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

        <!-- Block Dropdown -->
        <div class="mb-3">
            <label for="block" class="form-label">Select Block</label>
            <select id="block" name="block_id" class="form-select" required>
                <option value="">Select Block</option>
                @foreach($blocks as $block)
                    <option value="{{ $block->id }}">{{ $block->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Plot Dropdown or Sold Message -->
        <div class="mb-3" id="plot-container">
            <label for="plot_id" class="form-label">Select Plot</label>
            @if(count($availablePlots) > 0)
                <select name="plot_id" id="plot_id" class="form-select" required>
                    <option value="">-- Select Plot --</option>
                    @foreach($availablePlots as $plotItem)
                        <option value="{{ $plotItem->id }}">
                            Plot #{{ $plotItem->plot_number }} (Block: {{ $plotItem->block->name ?? 'N/A' }})
                        </option>
                    @endforeach
                </select>
            @else
                <div class="alert alert-warning mt-2">All plots are sold in all blocks.</div>
            @endif
        </div>

        <!-- Name -->
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Phone -->
        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
            @error('phone') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <!-- CNIC -->
        <div class="form-group">
            <label for="cnic" class="form-label">CNIC</label>
            <input type="text" name="cnic" class="form-control" value="{{ old('cnic') }}">
            @error('cnic') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Address -->
        <div class="form-group">
            <label for="address">Address</label>
            <textarea id="address" name="address" class="form-control" required>{{ old('address') }}</textarea>
            @error('address') <div class="alert alert-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Add Customer</button>
    </form>
</div>

<!-- JavaScript to fetch plots by block -->
<script>
    document.getElementById('block').addEventListener('change', function () {
        let blockId = this.value;
        let container = document.getElementById('plot-container');

        if (!blockId) {
            container.innerHTML = '<label class="form-label">Select Plot</label><div class="alert alert-warning">Please select a block.</div>';
            return;
        }

        fetch(`/get-plots/${blockId}`)
            .then(response => response.json())
            .then(data => {
                let html = '<label class="form-label" for="plot_id">Select Plot</label>';
                if (data.length > 0) {
                    html += `<select name="plot_id" id="plot_id" class="form-select" required>
                                <option value="">-- Select Plot --</option>`;
                    data.forEach(plot => {
                        html += `<option value="${plot.id}">Plot #${plot.plot_number}</option>`;
                    });
                    html += '</select>';
                } else {
                    html += '<div class="alert alert-warning mt-2">All plots are sold in this block.</div>';
                }
                container.innerHTML = html;
            });
    });
</script>
@endsection
