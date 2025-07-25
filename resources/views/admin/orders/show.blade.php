@extends('admin.app')
@php
    $title = 'Order Details';
    $sub_title = 'Orders';
@endphp
@section('title', $title)
@section('content')

    <div class="d-flex flex-column flex-column-fluid">
        <!-- Toolbar -->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                        {{ $title }}
                    </h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a class="text-muted text-hover-primary">{{ $sub_title }}</a>
                        </li>
                        <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                        <li class="breadcrumb-item text-muted">{{ $title }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card">
                    <div class="card-body p-lg-10">

                        <!-- Optional: Customer Info -->
                        <div class="mt-5">
                            <h5>Customer Info</h5>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-2"><strong>Name:</strong> {{ $order->full_name }}</div>
                                <div class="col-md-6 col-12 mb-2"><strong>Email:</strong> {{ $order->email }}</div>
                                <div class="col-md-6 col-12 mb-2"><strong>Phone:</strong> {{ $order->phone }}</div>
                                <div class="col-md-6 col-12 mb-2"><strong>Address:</strong> {{ $order->address }}, {{ $order->city }}</div>
                                <div class="col-md-6 col-12 mb-2"><strong>Payment Method:</strong> {{ ucfirst($order->payment_method) }}</div>
                                <div class="col-md-6 col-12 mb-2"><strong>Status:</strong></div>
                                @include('admin.orders.partials.dropdown_status', ['order', $order])
                            </div>

                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Product</th>
                                        <th>Thumbnail</th>
                                        <th>Color</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($order->items as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                {{ $item->product->name ?? 'N/A' }}<br>
                                                <small class="text-muted">Model: {{ $item->product->model ?? '-' }}</small>
                                            </td>
                                            <td>
                                                @if (!empty($item->product->thumbnail))
                                                    <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                                        width="60" height="60" style="object-fit: contain;">
                                                @else
                                                    <span class="text-muted">No Image</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->color }}</td>
                                            <td>${{ number_format($item->price, 2) }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td>${{ number_format($item->total, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No items found.</td>
                                        </tr>
                                    @endforelse

                                    <!-- Summary Rows -->
                                    <tr>
                                        <td colspan="6" class="text-end fw-bold">Subtotal</td>
                                        <td class="fw-bold">${{ number_format($order->subtotal, 2) }}</td>
                                    </tr>

                                    @if ($order->coupon)
                                        <tr>
                                            <td colspan="6" class="text-end fw-bold">
                                                Discount
                                                <small class="d-block text-muted">
                                                    Coupon: <strong>{{ $order->coupon->code }}</strong>
                                                    ({{ $order->coupon->type === 'percentage' ? $order->coupon->value . '%' : '$' . number_format($order->coupon->value, 2) }})
                                                </small>
                                            </td>
                                            <td class="fw-bold text-danger">
                                                -${{ number_format($order->discount, 2) }}
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-end fw-bold">
                                                Discount
                                            </td>
                                            <td class="fw-bold text-danger">
                                                ${{ number_format(0, 2) }}
                                            </td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <td colspan="6" class="text-end fw-bold">Total</td>
                                        <td class="fw-bold text-success">${{ number_format($order->total, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
