@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-6 text-center">Customers List</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-end mb-4">
        <a href="{{ route('customers.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-md transition">
            Add New Customer
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
            <thead class="bg-black text-white">
                <tr>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">Father Name</th>
                    <th class="px-6 py-3">Phone</th>
                    <th class="px-6 py-3">Block</th>
                    <th class="px-6 py-3">Plot #</th>
                    <th class="px-6 py-3">CNIC</th>
                    <th class="px-6 py-3">Total Paid</th>
                    <th class="px-6 py-3">Plot Price</th>
                    <th class="px-6 py-3">Actions</th>
                    <th class="px-6 py-3">Address</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($customers as $customer)
                <tr>
                    <td class="px-6 py-4">
                        <a href="{{ route('installments.byCustomer', $customer->id) }}" class="text-blue-600 hover:underline">
                            {{ $customer->name }}
                        </a>
                    </td>
                    <td class="px-6 py-4">{{ $customer->email }}</td>
                    <td class="px-6 py-4">{{ $customer->phone }}</td>
                    <td class="px-6 py-4">{{ $customer->block->name ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $customer->plot->plot_number ?? 'N/A' }}</td>
                    <td class="px-6 py-4">{{ $customer->cnic }}</td>
                    <td class="px-6 py-4"> {{ number_format($customer->total_paid ?? 0, 2) }} PKR</td>
                    <td class="px-6 py-4">
                        Rs. {{ $customer->plot->total_price ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4 flex flex-wrap gap-2">
                        <a href="{{ route('customers.edit', $customer->id) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">Edit</a>
                        <form class="btn btn-danger" action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">Delete</button>
                        </form>
                        <a href="{{ route('installments.create', $customer->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm">Add Installment</a>
                    </td>
                    <td class="px-6 py-4">{{ $customer->address }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
