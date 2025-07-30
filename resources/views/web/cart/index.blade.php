@extends('web.app')
@php
    $user = Auth::guard('customer')->check() ? Auth::guard('customer')->user() : null;
@endphp
@section('title', 'Ramco | Cart')
@section('css')
    <style>
        .input-wrapper {
            position: relative;
            width: 100%;
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 40px 12px 16px;
            font-size: 16px;
            border-radius: var(--12, 12px);
            border: 1px solid var(--black-10, rgba(28, 28, 28, 0.10));
            background: var(--white-80, rgba(255, 255, 255, 0.80));
            outline: none;
        }

        .input-wrapper .icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            pointer-events: none;
        }

        .input-wrapper label {
            color: var(--Colors-Neutral-800, #606060);
            font-feature-settings: 'ss01' on, 'cv01' on;
            font-size: 14px;
            font-style: normal;
            font-weight: 600;
            line-height: 20px;
            /* 142.857% */
        }

        .input-radio {
            padding: 15px;
            border-radius: var(--12, 12px);
            border: 1px solid var(--black-10, rgba(28, 28, 28, 0.10));
            background: var(--white-80, rgba(255, 255, 255, 0.80));
        }

        .input-radio input {
            background: black;
            color: black;
        }

        .product-model {
            font-size: 14px;
        }

        .discount {
            border: none !important;
            border-bottom: 1px solid var(--Colors-Primary-300, #6A6A6A) !important;
            border-radius: 0 !important;
        }

        html body .is-valid {
            border-color: #28a745 !important;
        }

        html body .is-invalid {
            border-color: #dc3545 !important;
        }
    </style>


@endsection
@section('content')
    <section class="products my-5">
        <div class="container">
            <div class="mb-4">
                <span class="muted-color">Home</span> / <span class="text-black">Cart </span>
            </div>

            <div class="row mb-3 ">
                <form action="{{ route('web.order.create') }}" method="POST" class="col-md-6 col-12 mb-3">
                    @csrf
                    <input type="text" name="coupon_code" id="coupon_code" value="{{ old('coupon_code') }}" hidden>
                    <div class="muted-color mb-2">1 of 3</div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div> Personal data</div>
                        <div>Have account? <a href="" class="muted-color">Sign In</a></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="mb-2"> Email</label>
                        <div class="input-wrapper">
                            <i class="fa fa-envelope icon"></i>
                            <input type="email" id="email" name="email" value="{{ $user ? $user->email :   old('email') }}"
                                placeholder="e-mail address" required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="mb-2"> Full Name</label>
                        <div class="input-wrapper">
                            <input type="text" id="name" name="full_name" value="{{ $user ? $user->name  : old('full_name') }}"
                                placeholder="Name" required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone-number" class="mb-2"> Phone Numbere</label>
                        <div class="input-wrapper">
                            <i class="fa fa-phone icon"></i>

                            <input type="text" name="phone" value="{{ $user ? $user->phone :  old('phone') }}" pattern="^\+?\d{7,15}$"
                                title="Enter a valid phone number (e.g. +123456789)" id="phone-number" placeholder="Number"
                                required />

                        </div>
                    </div>
                    <div class="muted-color mb-2">2 of 3</div>
                    <div class="mb-3">
                        <label for="city" class="mb-2"> City</label>
                        <div class="input-wrapper">
                            <i class="fa fa-city icon"></i>
                            <input type="text" id="city" name="city" value="{{ old('city') }}"
                                placeholder="City" required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="mb-2">Address</label>
                        <div class="input-wrapper">
                            <textarea id="address" name="address" class="w-100" placeholder="Address" rows="3">{{ $user ? $user->address :  old('address') }}</textarea>
                        </div>
                    </div>

                    <div class="muted-color mb-2">3 of 3</div>

                    <div class="mb-3">
                        <div class="input-radio ">
                            <input type="radio" name="payment_method" value="cash" id="cash_on-delivery" checked />
                            <label for="cash_on-delivery " class="mx-1">
                                Cash On Delivery
                            </label>
                        </div>
                    </div>
                    @if (count($items) > 0)
                        <button type="submit" class="w-100 main-btn desktop">Place Order</button>
                    @endif
                </form>
                <div class="col-md-6 col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="main-border-bottom p-2 mb-3">Shopping List</div>
                            <div class="cart-products mb-3 ">
                                @forelse ($items as $item)
                                    <div class="product main-border-bottom d-flex align-items-center gap-2 mb-3">
                                        <img src="{{ asset('storage/' . $item->product->thumbnail) }}"
                                            style="height: 150px;" alt="">

                                        <div class="w-100 d-flex h-100 flex-column justify-content-between h-100">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div class="product-name">
                                                    <div class="product-name">{{ $item->product->name }}</div>
                                                    <div class="muted-color product-model text-start my-1">
                                                        {{ $item->product->model }} – {{ $item->color }}
                                                    </div>
                                                    <span class="color" style="background: {{ $item->color }};"></span>
                                                </div>
                                                <div>{{ $item->price }} $</div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="text-muted">count: {{ $item->quantity }}</div>
                                                <button class="btn"
                                                    onclick="DeleteItemOfCart('{{ $item->id }}',this)">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-3">
                                        <h5>Your cart is currently empty.</h5>
                                        <a href="{{ route('web.pages.home') }}" class="main-btn mt-3">Continue
                                            Shopping</a>
                                    </div>
                                @endforelse
                                <div class="row main-border-bottom mb-3 mt-5">

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <div class="input-wrapper">
                                                <i class="fa fa-ticket icon"></i>
                                                <input type="text" class="discount" id="discount"
                                                    placeholder="Discount Code" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="muted-color">Subtotal</div>
                                            <div class="muted-color">{{ $order_summary['subtotal'] }} $ </div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="muted-color">Discount</div>
                                            <div class="muted-color" id="cart-discount">{{ $order_summary['discount'] }}
                                                $ </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-6"></div>
                                    <div class="col-6">
                                        <div class="d-flex justify-content-between mb-3">
                                            <div>Total</div>
                                            <div id="cart-total">{{ $order_summary['total'] }} $ </div>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <button class="w-100 main-btn mobile">Place Order</button>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#discount').on('blur', function() {
                let code = $(this).val().trim();
                let $input = $(this);
                let errorBoxId = 'coupon-error-msg';

                // إزالة الرسالة والخط الأحمر القديم
                $('#' + errorBoxId).remove();
                $input.removeClass('is-invalid');

                if (code === '') return;

                $.ajax({
                    url: '/apply-discount',
                    method: 'POST',
                    data: {
                        code: code,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $input.removeClass('is-invalid is-valid'); // إزالة أي كلاس سابق

                        if (data.error) {
                            $input.addClass('is-invalid');
                            $(`<div id="${errorBoxId}" class="text-danger mt-1">${data.error}</div>`)
                                .insertAfter($input);
                        } else {
                            $input.addClass('is-valid'); // ✅ إضافة حدود خضراء

                            $('#cart-discount').text(`${data.discount} $`);
                            $('#cart-total').text(`${data.total} $`);
                            $('#coupon_code').val(code)
                        }
                    },

                    error: function(xhr) {
                        let message = 'An error occurred.';
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            message = xhr.responseJSON.error;
                        }

                        $input.addClass('is-invalid');
                        $(`<div id="${errorBoxId}" class="text-danger mt-1">${message}</div>`)
                            .insertAfter($input);
                    }
                });
            });
        });
    </script>
@endsection
