@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-6">Edit Installment</h2>

    <form method="POST" action="{{ route('installments.update', $installment->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Amount Paid</label>
            <input type="number" name="amount_paid" value="{{ $installment->amount_paid }}" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Installment Date</label>
            <input type="date" name="installment_date" value="{{ $installment->installment_date }}" class="w-full p-2 border rounded" required>
        </div>

        <button type="submit" class="btn btn-warning btn-sm">Update</button>
    </form>
</div>
@endsection
