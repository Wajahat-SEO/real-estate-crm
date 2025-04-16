<!-- resources/views/installments/create.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Installment for {{ $customer->name }}</h2>

    <form action="{{ route('installments.store') }}" method="POST">
        @csrf

        <input type="hidden" name="customer_id" value="{{ $customer->id }}">

        <div class="form-group">
            <label for="amount_paid">Amount Paid</label>
            <input type="number" name="amount_paid" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="installment_date">Installment Date</label>
            <input type="date" name="installment_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Submit Installment</button>
    </form>
</div>
@endsection