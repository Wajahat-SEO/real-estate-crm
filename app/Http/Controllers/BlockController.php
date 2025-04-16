<?php

namespace App\Http\Controllers;

use App\Models\Block;
use Illuminate\Http\Request;
use App\Models\Plot;


class BlockController extends Controller
{
    public function index()
{
    $blocks = Block::all(); // Fetch all blocks from DB
    return view('blocks.index', compact('blocks')); // Return view with data
}

    public function create()
    {
        return view('blocks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:blocks|max:255',
            'description' => 'nullable',
        ]);

        Block::create($request->all());

        return redirect()->route('blocks.index')->with('success', 'Block created successfully.');
    }
    public function edit($id)
    {
        $block = Block::findOrFail($id);
        return view('blocks.edit', compact('block'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'total_plots' => 'required|integer',
        ]);

        $block = Block::findOrFail($id);
        $block->update($request->all());

        return redirect()->route('blocks.index')->with('success', 'Block updated successfully.');
    }

    public function destroy($id)
    {
        Block::destroy($id);
        return redirect()->route('blocks.index')->with('success', 'Block deleted successfully.');
    }

        public function getAvailablePlots($block_id)
    {
        $plots = Plot::where('block_id', $block_id)
                    ->whereNull('customer_id') // Only show unassigned plots
                    ->get(['id', 'plot_number']);

        return response()->json($plots);
    }


}

