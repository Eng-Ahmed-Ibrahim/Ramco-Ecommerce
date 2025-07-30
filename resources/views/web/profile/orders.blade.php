@extends('web.app')
@php $user=Auth::guard('customer')->user(); @endphp
@section('title', 'Ramco | My Account ')
@section('css')
    <style>
        .section-title {
            color: #444;
            font-size: 30px;
            font-style: normal;
            font-weight: 700;
            line-height: 69px;
        }

        .profile-title {
            font-size: 20px;
            font-weight: bold;
        }

        .color-danger {
            color: red;
        }
    </style>
@endsection
@section('content')
    <section class="my-5">
        <div class="container">
            <div class="mb-2">
                <span class="muted-color">Home</span> / <span class="text-black">Profile</span>
            </div>
            <div class="d-flex gap-2 align-items-center my-4">
                <a href="{{ route('web.profile.index') }}" class="main-btn-no-bg main-btn-sm">Account</a>
                <a href="{{ route('web.profile.orders') }}" class="main-btn main-btn-sm">My Orders</a>
            </div>

            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="section-title">My Orders</div>

            </div>
            <div class="card">
                <div class="card-body">
                    <div class="orders">
                        @foreach($orders as $order)
                        <div class="order mb-4">
                            {{-- order Details --}}
                            <div class="row mb-4">
                                <div class="col-md-3 col-sm-6 col-12 mb-3">
                                    <div class="bold">Order Date:</div>
                                    <div class="color-muted">{{ $order->created_at->format('F j, Y') }}</div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-12 mb-3">
                                    <div class="bold">Total Amount:</div>
                                    <div class="color-muted">{{ $order->total }} $</div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-12 mb-3">
                                    <div class="bold">Shipped to:</div>
                                    <div class="color-muted" style="white-space: pre-line;">{{ $order->address }}</div>
                                </div>
                                <div class="col-md-3 col-sm-6 col-12 mb-3">
                                    <div class="bold">Order Number:</div>
                                    <div class="color-muted">#{{ $order->id }}</div>
                                </div>

                            </div>
                            {{-- order items --}}
                            @foreach ($order->items as $item)
                            <div class="row">

                                <div class="col-md-2 col-sm-4 col-12 mb-3">
                                    <img class="max-width" src="{{ asset('storage/' . $item->product['thumbnail']) }}" >
                                </div>
                                <div class="col-md-10 col-sm-8 col-12 mb-3" style="display: flex;flex-direction: column;justify-content: space-between;">
                                    <div>
                                        <div class="product-name">{{ $item->product['name'] }}</div>
                                        <div class="color-muted">{{ $item->product['description'] }}</div>
                                    </div>
                                    <a href="{{ route('web.products.show',[$item->product['category']['slug'] , $item->product['slug'] ]) }}"> <i class="fa-regular fa-eye"></i> View Product</a>
                                </div>
                                </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')

@endsection
