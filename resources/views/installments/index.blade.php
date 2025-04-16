@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10 px-4 sm:px-6 lg:px-8 bg-white rounded shadow">

    {{-- ✅ Customer Info as List --}}
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-4">Customer Details</h2>
        <ul class="list-disc pl-6 space-y-1 text-gray-700">
            <li><strong>Name:</strong> {{ $customer->name }}</li>
            <li><strong>CNIC:</strong> {{ $customer->cnic }}</li>
            <li><strong>Phone:</strong> {{ $customer->phone }}</li>
            <li><strong>Email:</strong> {{ $customer->email }}</li>
            <li><strong>Address:</strong> {{ $customer->address }}</li>
        </ul>
    </div>

    {{-- ✅ Installment Table --}}
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-4">Installments</h2>

        <div class="overflow-x-auto rounded shadow">
            <table class="min-w-full bg-white border border-gray-300 text-sm text-left">
                <thead class="bg-black text-white">
                    <tr>
                        <th class="px-4 py-2 border">#</th>
                        <th class="px-4 py-2 border">Date</th>
                        <th class="px-4 py-2 border">Amount Paid</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($installments as $index => $installment)
                    <tr>
                        <td class="px-4 py-2 border">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border">{{ \Carbon\Carbon::parse($installment->payment_date)->format('d M Y') }}</td>
                        <td class="px-4 py-2 border">{{ number_format($installment->amount_paid, 2) }} PKR</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-2 border text-center text-gray-500">No installments found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ✅ Summary Info --}}
    @php
        $totalPaid = $installments->sum('amount_paid');
        $totalPrice = $customer->plot->total_price ?? 0;
        $remaining = $totalPrice - $totalPaid;
        $installmentsCount = $installments->count();
    @endphp

    <div class="bg-gray-100 p-4 rounded shadow-sm space-y-2">
        <p><strong>Total Plot Price:</strong> {{ number_format($totalPrice, 2) }} PKR</p>
        <p><strong>Total Paid:</strong> {{ number_format($totalPaid, 2) }} PKR</p>
        <p><strong>Remaining Amount:</strong> {{ number_format($remaining, 2) }} PKR</p>
        <p><strong>Number of Installments Paid:</strong> {{ $installmentsCount }}</p>

        @if($totalPaid >= $totalPrice)
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mt-4 font-semibold">
                ✅ Full payment has been received for this plot.
            </div>
        @endif
    </div>
</div>
@endsection
