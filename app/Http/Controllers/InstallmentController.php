<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Installment;
use App\Models\Customer;
use App\Models\Block;
use App\Models\Plot;

class InstallmentController extends Controller
{
    public function byCustomer($id)
    {
        $customer = Customer::findOrFail($id);
        $installments = Installment::where('customer_id', $id)->get();

        return view('installments.index', compact('installments', 'customer'));
    }

    public function index($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $installments = Installment::where('customer_id', $customerId)->get();
    
        return view('installments.index', compact('customer', 'installments'));
    }

    // InstallmentController.php
    public function create($customer_id)
    {
        // Fetch customer data using the ID
        $customer = Customer::findOrFail($customer_id);

        // Return the view with the customer data to pre-fill the installment form
        return view('installments.create', compact('customer'));
    }

    // InstallmentController.php
    public function store(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount_paid' => 'required|numeric',
            'installment_date' => 'required|date',
        ]);
    
        // Get the customer and their plot_id
        $customer = \App\Models\Customer::findOrFail($request->customer_id);
        $plotId = $customer->plot_id;
    
        // Create installment with plot_id
        Installment::create([
            'customer_id' => $request->customer_id,
            'plot_id' => $plotId,
            'amount_paid' => $request->amount_paid,
            'installment_date' => $request->installment_date,
        ]);
    
        return redirect()->route('customers.index')->with('success', 'Installment added successfully');
    }

        public function edit(Installment $installment)
    {
        return view('installments.edit', compact('installment'));
    }

        public function update(Request $request, Installment $installment)
    {
        $validated = $request->validate([
            'amount_paid' => 'required|numeric',
            'installment_date' => 'required|date',
        ]);

        $installment->update($validated);

        return redirect()->route('customers.index', ['customer' => $installment->customer_id])
        ->with('success', 'Installment updated successfully.');
    }

    public function destroy(Installment $installment)
    {
        $customerId = $installment->customer_id;
        $installment->delete();

        return redirect()->route('installments.index', ['customerId' => $customerId])
                        ->with('success', 'Installment deleted successfully.');
    }
}
