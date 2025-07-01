@extends('web.app')
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

        #discount {
            border: none !important;
            border-bottom: 1px solid var(--Colors-Primary-300, #6A6A6A) !important;
            border-radius: 0;
        }
    </style>
@endsection
@section('content')
    <section class="products my-5">
        <div class="container">
            <div class="mb-4">
                <span class="muted-color">Home</span> / <span>Cart </span>
            </div>

            <div class="row mb-3 ">
                <form class="col-md-6 col-12 mb-3">
                    <div class="muted-color mb-2">1 of 3</div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div> Personal data</div>
                        <div>Have account? <a href="" class="muted-color">Sign In</a></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="mb-2"> Email</label>
                        <div class="input-wrapper">
                            <i class="fa fa-envelope icon"></i>
                            <input type="email" id="email" placeholder="e-mail address" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="mb-2"> Full Name</label>
                        <div class="input-wrapper">
                            <input type="text" id="name" placeholder="Name" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone-number" class="mb-2"> Phone Numbere</label>
                        <div class="input-wrapper">
                            <i class="fa fa-phone icon"></i>

                            <input type="text" id="phone-number" placeholder="Number" />
                        </div>
                    </div>
                    <div class="muted-color mb-2">2 of 3</div>
                    <div class="mb-3">
                        <label for="city" class="mb-2"> City</label>
                        <div class="input-wrapper">
                            <i class="fa fa-city icon"></i>
                            <input type="text" id="city" placeholder="City" />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="mb-2"> Address</label>
                        <div class="input-wrapper">
                            <i class="fa fa-map-marker-alt icon"></i>
                            <input type="text" id="address" placeholder="Address" />
                        </div>
                    </div>
                    <div class="muted-color mb-2">3 of 3</div>
                    <div class="mb-3">
                        <div class="input-radio ">
                            <input type="radio" id="visa" />
                            <label for="visa" class="mx-1">
                                Visa,Master Card
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="input-radio ">
                            <input type="radio" id="cash_on-delivery" checked />
                            <label for="cash_on-delivery " class="mx-1">
                                Cash On Delivery
                            </label>
                        </div>
                    </div>
                    <button class="w-100 main-btn desktop">Place Order</button>

                </form>
                <div class="col-md-6 col-12 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="main-border-bottom p-2 mb-3">Shopping List</div>
                            <div class="cart-products mb-3 ">
                                @for ($i = 0; $i < 3; $i++)
                                    <div class="product main-border-bottom d-flex align-items-center gap-2 mb-3">
                                        <img src="{{ asset('static/product4.png') }}" style="height: 150px;" alt="">

                                        <div class="w-100 d-flex h-100 flex-column justify-content-between h-100">
                                            <div class="d-flex justify-content-between mb-5">
                                                <div class="product-name">
                                                    <div class="product-name">Induction Cooker</div>
                                                    <div class="muted-color product-model text-start my-1">RI-910 – White
                                                    </div>
                                                    <span class="color" style="background: white;"></span>
                                                </div>
                                                <div>27 $</div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="text-muted">count: 1</div>
                                                <form action="">
                                                    <button class="btn">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                                <div class="row main-border-bottom mb-3 mt-5">

                                    <div class="col-6">
                                        <div class="mb-3">
                                            <div class="input-wrapper">
                                                <i class="fa fa-ticket icon"></i>
                                                <input type="text" id="discount" placeholder="Discount Code" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="muted-color">Sale</div>
                                            <div class="muted-color">0:00 $ </div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="muted-color">Subtotal</div>
                                            <div class="muted-color">56 $ </div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="muted-color">Shipping</div>
                                            <div class="muted-color">0 $ </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row mb-3">
                                    <div class="col-6"></div>
                                    <div class="col-6">
                                        <div class="d-flex justify-content-between mb-3">
                                            <div>Total</div>
                                            <div>0:00 $ </div>
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

@endsection
