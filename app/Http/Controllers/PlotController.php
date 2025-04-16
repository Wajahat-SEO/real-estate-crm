<?php

namespace App\Http\Controllers;

use App\Models\Plot;
use App\Models\Block;
use Illuminate\Http\Request;

class PlotController extends Controller
{
    public function index()
    {
        $plots = Plot::with('block')->get();
        return view('plots.index', compact('plots'));
    }

    public function create()
    {
        $blocks = Block::all();
        return view('plots.create', compact('blocks'));
    }

    public function store(Request $request)
    {
        // Validation        
        $request->validate([
            'block_id' => 'required|exists:blocks,id',
            'plot_number' => 'required',
            'size' => 'required',
            'status' => 'required|boolean', // Ensure status is either true (Available) or false (Sold)
            'total_price' => 'required|numeric|min:0',
        ]);
    
        // Store the plot data in the database
        $plot = new Plot();
        $plot->block_id = $request->block_id;
        $plot->plot_number = $request->plot_number;
        $plot->size = $request->size;
        $plot->status = $request->status;
        $plot->total_price = $request->total_price;
        $plot->save();
    
        return redirect()->route('plots.index')->with('success', 'Plot created successfully.');
     }

    public function edit($id)
    {
        $plot = Plot::findOrFail($id);
        $blocks = Block::all();
        return view('plots.edit', compact('plot', 'blocks'));
    }

    public function update(Request $request, $id)
    {
        // Validation
    $request->validate([
        'block_id' => 'required|exists:blocks,id',
        'plot_number' => 'required',
        'size' => 'required',
        'status' => 'required|boolean', // Ensure status is a boolean value
        'total_price' => 'required|numeric|min:0',
    ]);

    // Fetch the plot
    $plot = Plot::findOrFail($id);

    // Update the plot's attributes
    $plot->block_id = $request->block_id;
    $plot->plot_number = $request->plot_number;
    $plot->size = $request->size;
    $plot->status = (bool) $request->status;  // Convert to boolean: true for "Available", false for "Sold"
    $plot->total_price = $request->total_price;
    $plot->save();

    return redirect()->route('plots.index')->with('success', 'Plot updated successfully.');
  }

    public function destroy($id)
    {
        Plot::destroy($id);
        return redirect()->route('plots.index')->with('success', 'Plot deleted successfully.');
    }
    public function getPlots($blockId)
    {
        $plots = Plot::where('block_id', $blockId)->get(['id', 'plot_number']);
        return response()->json($plots);
    }
}
