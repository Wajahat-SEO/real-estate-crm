<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Block;
use App\Models\Plot;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Show all customers
    public function index()
    {
         $customers = Customer::with(['block', 'plot'])
        ->withSum('installments as total_paid', 'amount_paid') // 👈 this adds the total_paid column
        ->get();
        return view('customers.index', compact('customers'));
    }

    // Show create form
    public function create()
    {
        $blocks = Block::all();
        $availablePlots = Plot::where('status', true)->get();
        return view('customers.create', compact('blocks', 'availablePlots'));
    }

    // Store new customer
    public function store(Request $request)
    {
    // Validate the input data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:customers,email',  // Ensure email is unique
        'phone' => 'required|string',
        'address' => 'required|string',
        'block_id' => 'required|integer',
        'plot_id' => 'required|integer',
        'cnic' => 'required|string|max:15',
    ]);

    // Create the customer record
    Customer::create($validatedData);

        // Mark plot as sold
        $plot = Plot::find($request->plot_id);
        if ($plot) {
            $plot->status = false;
            $plot->save();
        }

        // Redirect with success message
        return redirect()->route('customers.index')->with('success', 'Customer created successfully!');

        }

    // Show edit form
    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        $blocks = Block::all();

        // Include current plot so it can be edited properly even if sold
        $availablePlots = Plot::where('status', true)
            ->orWhere('id', $customer->plot_id) // include current assigned plot
            ->get();
    
        return view('customers.edit', compact('customer', 'blocks', 'availablePlots'));
    }

    // Update customer
    public function update(Request $request, $uuid)
    {
   
            // Find the customer by UUID
        $customer = Customer::where('uuid', $uuid)->firstOrFail();

        if ($customer->plot_id && $customer->plot_id != $request->plot_id) {
            Plot::where('id', $customer->plot_id)->update(['status' => true]);
        }

        // Validate the input data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,  // Exclude current customer's email
            'phone' => 'required|string',
            'address' => 'required|string',
            'block_id' => 'required|integer',
            'plot_id' => 'required|integer',
            'cnic' => 'required|string|max:15',
        ]);

        // Update the customer record
        $customer->update($validatedData);

            // Mark new plot as sold
            Plot::where('id', $request->plot_id)->update(['status' => false]);

        // Save updated customer data
        if ($customer->save()) {
            return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
        } else {
            return back()->with('error', 'Failed to update customer!');
        }
    }

    // Delete customer
    public function destroy($uuid)
    {
        $customer = Customer::findOrFail($uuid);
         // Free up the plot
        Plot::where('id', $customer->plot_id)->update(['status' => true]);
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }

    // Return block and plot details (optional)
    public function getDetails(Customer $customer)
    {
        return response()->json([
            'block' => $customer->block->name ?? 'N/A',
            'plot' => $customer->plot->plot_number ?? 'N/A',
        ]);
    }
}
