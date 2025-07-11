@extends('web.app')
@section('title', 'Ramco')
@section('css')
    <style>
        .swiper-button-prev:after,
        .swiper-rtl .swiper-button-next:after {
            content: 'prev';
            font-size: 20px;
            color: black;
        }

        .swiper-button-next:after,
        .swiper-rtl .swiper-button-prev:after {
            content: 'next';
            font-size: 20px;
            color: black;
        }

        body {
            overflow: hidden;
            height: 100%;
        }

        .form {
            background: white;
            position: fixed;
            top: 0;
            right: 0;
            height: 100vh;
            width: 46%;
            z-index: 9999;
        }

        @media (max-width: 768px) {
            .form {
                width: 100%;
                    position: relative;
                    height: auto !important;
            }
            body{
                overflow: auto;
            }
            .navbar{
                display: none;
            }
        }

        .card-header,
        .card-header i {
            color: var(--Colors-Primary-400, #444);
            text-align: center;
            font-size: 26px;
            font-style: normal;
            font-weight: 700;
            line-height: 48px;
            /* 150% */
        }

        .login-btn {
            background: var(--Colors-Primary-Alpha-10, rgba(31, 31, 31, 0.10));


        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 2px solid #ddd;
        }

        .divider:not(:empty)::before {
            margin-right: .75em;
        }

        .divider:not(:empty)::after {
            margin-left: .75em;
        }

        .divider span {
            color: #777;
            font-weight: 600;
            letter-spacing: 1px;
        }
        .login-link{
            text-decoration: underline !important;
            color: black;
        }
    </style>
@endsection
@section('content')
    <section class="home ">

        <section class="hero desktop mb-5">
            <div class="container py-5 mx-4" style="height: 100vh;">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-12 mb-3">
                        <span class="hero-text">UNLEASH THE POWER With Blender RB-663 </span>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        <div class="d-md-flex d-block text-md-start text-center align-items-center ">

                            <img src="{{ asset('static/hero_image.png') }}" class="mb-3" alt="">

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="form">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <a href="/" class="btn"><i class="fa-solid fa-xmark"></i> </a>
                    <span>Create an account</span>

                </div>
                <div class="card-body">

                    <div class="mt-2 mx-md-5 mx-2">

                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="first_name" class="mb-2"> First Name</label>
                                <div class="input-wrapper">
                                    {{-- <i class="fa fa-envelope icon"></i> --}}
                                    <input type="text" name="first_name" id="first_name" placeholder="First Name " />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="last_name" class="mb-2"> Last Name</label>
                                <div class="input-wrapper">
                                    {{-- <i class="fa fa-envelope icon"></i> --}}
                                    <input type="text" name="last_name" id="last_name" placeholder="Last Name " />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="mb-2"> Email</label>
                                <div class="input-wrapper">
                                    {{-- <i class="fa fa-envelope icon"></i> --}}
                                    <input type="email" name="email" id="email" placeholder="email address" />
                                </div>
                            </div>
               
                            <div class="mb-3">
                                <label for="password" class="mb-2"> Password</label>
                                <div class="input-wrapper">
                                    <input type="password" id="password" placeholder="Password" />
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="confirm_password" class="mb-2">Confirm Password</label>
                                <div class="input-wrapper">
                                    <input type="password" id="confirm_password" placeholder="Confirm Password" />
                                </div>
                            </div>
                            <button class="main-btn login-btn w-100">Create Account</button>
                        </form>
                        <div class="text-center mt-3">
                            Already have an account? <a class="login-link" href="/login">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>
@endsection
