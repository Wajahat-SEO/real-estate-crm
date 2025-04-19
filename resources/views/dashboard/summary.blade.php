<!-- resources/views/summary.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    {{-- Summary Cards --}}
    <div>
    <div class="row text-center mb-4 d-flex justify-content-between">
        <div class="col-md-3 mb-3">
            <div class="card border border-dark shadow-sm h-100" style="background-color: burlywood; padding:17px;">
                <div class="card-body text-black fw-bold">
                    <h6>Total Plot Price</h6>
                    <h4>Rs {{ number_format($totalPlotPrice) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border border-dark shadow-sm h-100" style="background-color: burlywood; padding:17px;">
                <div class="card-body text-black fw-bold">
                    <h6>Total Paid</h6>
                    <h4>Rs {{ number_format($totalPaid) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border border-dark shadow-sm h-100" style="background-color: burlywood; padding:17px;">
                <div class="card-body text-black fw-bold">
                    <h6>Pending Installments</h6>
                    <h4>Rs {{ number_format($pendingInstallments) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border border-dark shadow-sm h-100" style="background-color: burlywood; padding:17px;">
                <div class="card-body text-black fw-bold">
                    <h6>Total Customers</h6>
                    <h4>{{ $totalCustomers }}</h4>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div>
    {{-- Overall Plots Status --}}
    <div class="row justify-content-center mb-5" style="background-color: burlywood;">
        <div class="col-auto">
            <div class="card border border-dark shadow-sm text-center">
                <div class="card-body">
                    <h6 class="fw-bold text-black">Plots: Sold vs Available</h6>
                    <canvas id="plotsStatusChart" style="max-width:250px; max-height:250px;"></canvas>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Overall Sold vs Available
    new Chart(document.getElementById('plotsStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Sold', 'Available'],
            datasets: [{
                data: [{{ $soldPlots }}, {{ $availablePlots }}],
                backgroundColor: ['#dc3545', '#28a745']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '70%',
            plugins: { legend: { position: 'bottom' } }
        }
    });
});
</script>
@endpush
