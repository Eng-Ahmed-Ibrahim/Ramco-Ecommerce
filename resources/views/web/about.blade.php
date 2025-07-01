@extends('web.app')
@section('title', 'Ramco | About Us')
@section('css')
    <style>
        .video-section {
            overflow-x: hidden;
            background: #f5f5f5;
        }

        .video-section .full-image {
            width: 100%;
            height: 100%;
            display: block;
            position: absolute;
            opacity: 0.9;

        }

        .about-description {
            color: #000;

            font-size: 19px;
            font-style: normal;
            font-weight: 600;
            line-height: 27px;
        }

        .our-products {
            color: var(--Colors-Secondary-300, #E2211C);
            text-align: center;
            font-size: 40px;
            font-style: normal;
            font-weight: 700;
            line-height: 69px;
            /* 150% */
        }

        @media (max-width: 768px) {

            .our-products {
                color: var(--Colors-Secondary-300, #E2211C);
                text-align: center;
                font-size: 25px;
                font-style: normal;
                font-weight: 700;
                line-height: 50px;
            }
        }
    </style>
@endsection
@section('content')
    <section class="about my-5">
        <div class="container">
            <div class="mb-5">
                <span class="muted-color">Home</span> / <span>About Us </span>
            </div>
            <div class="section-title black-color my-4">About Us </div>

            <section class="video-section mb-5 row justify-content-around align-items-center">
                <img src="{{ asset('static/about.webp') }}" alt="About" class="full-image">

                <div class="video-content col-md-4 col-sm-6 col-12">
                    <div class="container ">

                        <div class="video-title black-color">Our history</div>
                        <div class="about-description">
                            <span class="main-color">Kasem Group </span>for Engineering Industries, RAMCO Brand, well known,
                            and famous company, was established in 1993. It is specialized in electric household appliances.
                            It is located near the Syrian capital Damascus, in Adra Industrial City, Damascus suburb, on a
                            land of 40,000 SQM, with 6 building and 300 employees.

                        </div>
                    </div>
                </div>
                <div class="col-4"></div>
            </section>

            <div class="row mb-3">
                <div class="col-md-6 col-12 mb-3">
                    <div class="section-title main-color main-border-bottom px-2 mb-3" style="font-size: 30px">
                        OUR SUCCESS
                    </div>
                    <div class="about-description">
                        After sales service is one of the key success factors of Kasem Group, where a comprehensive team,
                        call centre, home maintenance team and maintenance centres in Damascus, Aleppo and other
                        territories. Maintenance is fully free during warranty and only cost out of it.
                    </div>
                </div>
                <div class="col-md-6 col-12 mb-3">
                    <div class="section-title main-color main-border-bottom px-2 mb-3" style="font-size: 30px">
                        OUR VISION
                    </div>
                    <div class="about-description">
                        Our vision is based on building distinguished relation with our customers, either sellers or
                        consumers, through long team strategy based on partnership and trust rather than market share or
                        profit.
                    </div>
                </div>
            </div>
            <div class="my-5 main-color our-products text-center">
                Our products known, and trusted not just locally, but also in Lebanon, Jordan, Iraq and Turkey. We have
                distributers in all around countries.

            </div>
            <div class="row mb-3 align-items-center">
                <div class="col-md-5 col-12 order-2 order-md-1 mb-3">
                    <div class="section-title main-color main-border-bottom px-2 mb-3" style="font-size: 30px">
                        +50 Products
                    </div>
                    <div class="about-description">
                        Kasem Group produces more than fifty different products (Water Dispenser, Washing Machine, Air
                        conditioning, Vacuum Cleaner, Fan, Mixer, Meat Grinder, Juice Extractor, Hair Dryer, Iron, and so
                        on).
                    </div>
                </div>
                <div class="col-md-7 col-12 text-center  order-1 order-md-2 mb-3">
                    <img src="{{ asset('static/about 2.webp') }}" class="max-width" alt="">
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
@endsection
