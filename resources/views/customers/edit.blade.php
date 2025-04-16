@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Customer</h2>

    <form action="{{ route('customers.update', $customer->uuid) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Block Dropdown -->
        <div class="mb-3">
            <label for="block" class="form-label">Select Block</label>
            <select id="block" name="block_id" class="form-select" required>
                <option value="">Select Block</option>
                @foreach($blocks as $block)
                    <option value="{{ $block->id }}" {{ $customer->block_id == $block->id ? 'selected' : '' }}>{{ $block->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Plot Dropdown -->
        <div class="mb-3" id="plot-container">
            <label for="plot_id" class="form-label">Select Plot</label>
            @if(count($availablePlots) > 0 || $customer->plot)
                <select name="plot_id" id="plot_id" class="form-select" required>
                    <option value="">-- Select Plot --</option>
                    @foreach($availablePlots as $plotItem)
                        <option value="{{ $plotItem->id }}"
                            {{ old('plot_id', $customer->plot_id) == $plotItem->id ? 'selected' : '' }}>
                            Plot #{{ $plotItem->plot_number }} (Block: {{ $plotItem->block->name ?? 'N/A' }})
                        </option>
                    @endforeach
                    @if($customer->plot && !$availablePlots->contains('id', $customer->plot_id))
                        <option value="{{ $customer->plot->id }}" selected>
                            Plot #{{ $customer->plot->plot_number }} (Block: {{ $customer->plot->block->name ?? 'N/A' }}) — Assigned
                        </option>
                    @endif
                </select>
            @else
                <div class="alert alert-warning mt-2">All plots are sold in this block.</div>
            @endif
        </div>

        <!-- Customer Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Customer Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $customer->name) }}" required>
        </div>

        <!-- Customer Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $customer->email) }}" required>
        </div>

        <!-- Customer Phone -->
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $customer->phone) }}" required>
        </div>

        <!-- CNIC -->
        <div class="mb-3">
            <label for="cnic" class="form-label">CNIC</label>
            <input type="text" name="cnic" class="form-control" value="{{ old('cnic', $customer->cnic ?? '') }}">
        </div>

        <!-- Address -->
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" class="form-control" required>{{ old('address', $customer->address) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Customer</button>
    </form>
</div>

<!-- JavaScript to Fetch Plots Based on Selected Block -->
<script>
    document.getElementById('block').addEventListener('change', function () {
        let blockId = this.value;
        let plotContainer = document.getElementById('plot-container');

        if (!blockId) {
            plotContainer.innerHTML = '<label class="form-label">Select Plot</label><div class="alert alert-warning">Please select a block.</div>';
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
                plotContainer.innerHTML = html;
            });
    });
</script>
@endsection
