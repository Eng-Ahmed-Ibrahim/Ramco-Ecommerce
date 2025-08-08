@extends('web.app')
@section('title', 'Ramco | About Us')
@section('css')
    <style>
        .video-section {
            overflow-x: hidden;
            background: #f5f5f5;
            background-image: url('{{ asset('storage.' . $background_about->background_desktop) }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

        }

        @media (max-width: 768px) {
            .video-section {
                background-image: url('{{ asset('storage.' . $background_about->background_mobile) }}');
                background-position: center;

            }
        }

        .video-content {
            padding: 20px !important;
            background: #00000059;
            border-radius: 0;
        }

        .video-section .full-image {
            width: 100%;
            height: 100%;
            display: block;
            position: absolute;
            opacity: 0.9;
            padding: 0;

        }

        .about-description {
            color: white;

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
                line-height: 39px;
            }
        }
    </style>
@endsection
@section('content')
    <section class="about my-4 ">
        <div class="container">
            <div class="mb-3">
                <span class="muted-color">Home</span> / <span class="text-black">About Us </span>
            </div>
            <div class="section-title black-color my-3">About Us </div>

            <section class="video-section mb-5 row justify-content-around align-items-center">

                <div class="video-content col-md-4 col-sm-6 col-12">
                    <div class="container ">

                        @php
                            $description = str_replace(
                                'Kasem Group',
                                '<span class="blue-color">Kasem Group</span>',
                                $background_about->description,
                            );
                        @endphp

                        <div class="video-title ">{{ $background_about->title }}</div>
                        <div class="about-description">
                            {!! $description !!}
                        </div>

                    </div>
                </div>
                <div class="col-4"></div>
            </section>

            <div class="row mb-3">
                @for($i=1;$i<3;$i++)
                <div class="col-md-6 col-12 mb-3">
                    <div class="section-title blue-color main-border-bottom px-2 mb-3" style="font-size: 30px">
                        {{ $about_page[$i]->name }}
                    </div>
                    <div class="about-description text-black">{{ $about_page[$i]->description }}</div>
                </div>
                @endfor
        
            </div>
            <div class="my-5 blue-color our-products text-center">{{ $background_about->text }} </div>
            <div class="row mb-3 align-items-center">
                <div class="col-md-5 col-12 order-2 order-md-1 mb-3">
                    <div class="section-title blue-color main-border-bottom px-2 mb-3" style="font-size: 30px">
                         {{ $about_page[0]->name }}
                    </div>
                    <div class="about-description text-black">{{ $about_page[0]->description }}</div>
                </div>
                <div class="col-md-7 col-12 text-center  order-1 order-md-2 mb-3">
                    <img src="{{ asset('storage/'.$about_page[0]->icon ) }}" class="max-width" alt="">
                </div>
            </div>
        </div>
    </section>

@endsection
@section('js')
@endsection
