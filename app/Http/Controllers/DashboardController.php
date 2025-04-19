<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Plot;
use App\Models\Installment;
use App\Models\Block;

class DashboardController extends Controller
{
    // Home page or dashboard landing
    public function index()
    {
        return view('dashboard.summary'); // existing layout
    }

    // New method for summary dashboard
    public function summary()
    {
        // 1) Total plot price
        $totalPlotPrice = Plot::sum('total_price');
    
        // 2) Total amount paid by customers
        $totalPaid = Installment::sum('amount_paid');
    
        // 3) Pending installments = revenue still to be collected
        $pendingInstallments = $totalPlotPrice - $totalPaid;
    
        // 4) Totals
        $totalCustomers = Customer::count();
        $soldPlots      = Plot::where('status', 'on')->count();
        $availablePlots = Plot::where('status', 'off')->count();
    
        // 5) Plots per block
        $plotsByBlock = Block::withCount([
            'plots as sold_plots_count'      => fn($q) => $q->where('status', 'on'),
            'plots as available_plots_count' => fn($q) => $q->where('status', 'off'),
        ])->get();

                // Inside your method
        $blocks = Block::with('plots')->get()->map(function ($block) {
            $sold = $block->plots->where('status', 'on')->count();
            $available = $block->plots->where('status', 'off')->count();
            return (object)[
                'id' => $block->id,
                'name' => $block->name,
                'sold' => $sold,
                'available' => $available,
            ];
        });
    
        return view('dashboard.summary', [
            'totalPlotPrice' => $totalPlotPrice,
            'totalPaid' => $totalPaid,
            'pendingInstallments' => $pendingInstallments,
            'totalCustomers' => $totalCustomers,
            'soldPlots' => $soldPlots,
            'availablePlots' => $availablePlots,
            'blocks' => $blocks
        ]);
    }
    
}