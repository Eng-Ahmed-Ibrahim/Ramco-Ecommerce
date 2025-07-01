@extends('web.app')
@section('title', 'Ramco | News ')
@section('css')
    <style>
        .article-title {
            color: var(--Colors-Primary-500, #1F1F1F);
            font-size: 40px;
            font-style: normal;
            font-weight: 700;
            line-height: 69px;
            /* 150% */
        }

        @media (max-width: 768px) {
            .article-title {
                color: var(--Colors-Primary-500, #1F1F1F);
                font-size: 24px;
                font-style: normal;
                font-weight: 700;
                line-height: 40px;
            }
        }

        .article-description {
            color: var(--Colors-Primary-400, #444);
            font-size: 18px;
            font-style: normal;
            font-weight: 700;
            line-height: 33px;
        }

        .sub-description {
            color: var(--Colors-Primary-400, #444);
            font-size: 16px;
            font-style: normal;
            font-weight: 700;
            line-height: 33px;
            /* 150% */
        }

        .sub-title {
            color: var(--Colors-Primary-500, #1F1F1F);
            font-size: 25px;
            font-style: normal;
            font-weight: 700;
            line-height: 48px;
            /* 150% */
        }

        @media (max-width: 768px) {
            .sub-title {
                color: var(--Colors-Primary-500, #1F1F1F);
                font-size: 21px;
                font-style: normal;
                font-weight: 700;
                line-height: 48px;
                /* 150% */
            }
        }
    </style>
@endsection
@section('content')
    <section class="products my-5">
        <div class="container">
            <div class="mb-4">
                <span class="muted-color">Home / News </span> / <span>Article </span>
            </div>
            <div class="row mb-3">
                <div class="col-md-8 col-12 article-title">
                    Al-Kassem Engineering Industries Group Hosts Juthoor Association and Children with Love Syndrome
                </div>
            </div>
            <div class="mb-3">
                <img class="w-100 article-img" src="{{ asset('static/news.webp') }}" alt="">
            </div>
            <div class="mb-5 article-description">
                As part of its commitment to social responsibility and the integration of people with special needs into
                society, Al-Kassem Engineering Industries Group hosted the Juthoor Association and its children with Love
                Syndrome at its industrial facility in the Adar Industrial Zone. The event was filled with activities and
                experiences that brought joy and love to all participants.
            </div>
            <div class="row ">
                <div class="col-md-6 col-12 mb-4">
                    <img src="{{ asset('static/news2.webp') }}" class="w-100" loading="lazy" alt="">
                </div>
                <div class="col-md-6 col-12 mb-4">
                    <div class="sub-title mb-3">Exploring Machines and Technologies</div>
                    <div class="sub-description">As part of its commitment to social responsibility and the integration of
                        people with special needs into society, Al-Kassem Engineering Industries Group hosted the Juthoor
                        Association and its children with Love Syndrome at its industrial facility in the Adar Industrial
                        Zone. The event was filled with activities and experiences that brought joy and love to all
                        participants.</div>
                </div>
                <div class="section mb-4 col-12">
    
                    <div class="sub-title mb-2">Exploring Machines and Technologies</div>
                    <div class="sub-description">As part of its commitment to social responsibility and the integration of
                        people with special needs into society, Al-Kassem Engineering Industries Group hosted the Juthoor
                        Association and its children with Love Syndrome at its industrial facility in the Adar Industrial
                        Zone. The event was filled with activities and experiences that brought joy and love to all
                        participants.</div>
                    </div>
            </div>
        </div>
    </section>
@endsection
@section('js')

@endsection
