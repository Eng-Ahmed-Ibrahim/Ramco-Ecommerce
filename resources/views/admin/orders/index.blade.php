@extends('admin.app')
@php
    $title = 'Orders';
    $sub_title = 'Pages';
@endphp
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
                    <div class="card-body p-lg-10">

                        <!-- Search form -->
                        <form method="GET" class="mb-4 row">
                            <div class="col-md-4">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                    placeholder="Search by name, email, ID...">
                            </div>
                            <div class="col-md-3">
                                <select name="status" class="form-control">
                                    <option value="">All Statuses</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>
                                        Delivered</option>
                                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>
                                        Canceled</option>
                                    <option value="returned" {{ request('status') == 'returned' ? 'selected' : '' }}>
                                        Returned</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>

                        <!-- Orders Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Currency</th>
                                        <th>Total</th>
                                        <th>Payment</th>
                                        <th>Created</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <td>

                                                @can('orders-show')
                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                    >#{{ $order->id }}</a>
                                                    @endcan
                                            </td>
                                            <td>{{ $order->full_name }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td><span
                                                    class="badge bg-light-{{ $order->status == 'pending' ? 'warning' : 'success' }}">{{ ucfirst($order->status) }}</span>
                                            </td>
                                            <td>{{ $order->currency }}</td>
                                            <td>{{  GetCurrencyExchange($order->currency, $order->total)  }}
                                            </td>
                                            <td>{{ ucfirst($order->payment_method) }}</td>
                                            <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                @include('admin.orders.partials.dropdown_status', [
                                                    'order',
                                                    $order,
                                                ])
                                            </td>


                                            <td>
                                                @can('orders-show')
                                                <a href="{{ route('admin.orders.show', $order->id) }}"
                                                    class="btn btn-sm btn-info">Show</a>
                                                    @endcan
                                                    @can('orders-delete')
                                                <form action="{{ route('admin.orders.destroy', $order->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this order? This action cannot be undone.')">
                                                        Delete
                                                    </button>
                                                </form>
                                                @endcan

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">No orders found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $orders->links('vendor.pagination.custom') }}

                        </div>

                        <div class="mt-4">
                            {{ $orders->withQueryString()->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function updateStatus(orderId, status) {
            fetch(`/orders/${orderId}/status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status
                    })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        alert('Status updated successfully!');
                    } else {
                        alert('Failed to update status');
                    }
                });
        }
    </script>

@endsection
