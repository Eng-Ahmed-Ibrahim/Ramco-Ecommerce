@extends('admin.app')
@php
    $title = 'Dashboard';
    $sub_title = 'Pages';
@endphp
@section('css')
<style>
    .white-color{
        color: white;
    }
</style>
@endsection
@section('title', $title)
@section('content')
    <div class="d-flex flex-column flex-column-fluid">

        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        {{ $title }}</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a class="text-muted text-hover-primary">{{ $sub_title }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">{{ $title }}</li>
                    </ul>
                </div>
        
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card">
                    <div class="card-body p-lg-17">

                        @can('dashboard-view')
                        <div class="container mt-4">

                            {{-- 4 Status Cards --}}
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card text-center bg-warning text-white">
                                        <a href="{{ route('admin.orders.index',['status'=>"pending"]) }}" class="card-body">
                                            <h5>Pending Orders</h5>
                                            <h2>{{ $pendingCount }}</h2>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-center bg-success text-white">
                                        <a href="{{ route('admin.orders.index',['status'=>"delivered"]) }}" class="card-body">
                                            <h5>Delivered Orders</h5>
                                            <h2>{{ $deliveredCount }}</h2>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-center bg-danger text-white">
                                        <a href="{{ route('admin.orders.index',['status'=>"returned"]) }}" class="card-body">
                                            <h5>Returned Orders</h5>
                                            <h2>{{ $returnedCount }}</h2>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card text-center bg-dark text-white">
                                        <a href="{{ route('admin.orders.index',['status'=>"cancelled"]) }}" class="card-body white-color">
                                            <h5 class="white-color">Cancelled Orders</h5>
                                            <h2  class="white-color">{{ $cancelledCount }}</h2>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            {{-- Graph - Monthly Sales --}}
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h5>Monthly Delivered Orders</h5>
                                </div>
                                <div class="card-body">
                                    <canvas id="salesChart"></canvas>
                                </div>
                            </div>

                            {{-- 2 More Cards --}}
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="card text-center bg-info text-white">
                                        <div class="card-body">
                                            <h5>Total Products</h5>
                                            <h2>{{ $totalProducts }}</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card text-center bg-primary text-white">
                                        <div class="card-body">
                                            <h5>Top Selling Product</h5>
                                            @if ($topSellingProduct)
                                                <h4>{{ $topSellingProduct->name }}</h4>
                                                <p>Sold: {{ $topSellingProduct->total_sold }}</p>
                                            @else
                                                <p>No sales yet</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @else
                        <div>
                            Welcome back
                        </div>
                        @endcan




                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(
                    array_map(function ($m) {
                        return date('F', mktime(0, 0, 0, $m, 1));
                    }, array_keys($monthlySales->toArray())),
                ) !!},
                datasets: [{
                    label: 'Delivered Orders',
                    data: {!! json_encode(array_values($monthlySales->toArray())) !!},
                    borderColor: 'blue',
                    backgroundColor: 'rgba(0, 0, 255, 0.2)',
                    fill: true,
                    tension: 0.1
                }]
            }
        });
    </script>
@endsection
