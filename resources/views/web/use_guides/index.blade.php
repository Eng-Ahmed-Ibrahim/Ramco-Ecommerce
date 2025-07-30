@extends('web.app')
@section('title', 'Ramco | Smart Use Guides')
@section('css')
    <style>
        .news-title {
            color: var(--Colors-Primary-500, #1F1F1F);
            font-size: 23px;
            font-style: normal;
            font-weight: 700;
            line-height: 39px;
            /* 150% */

        }

        .news-date {
            color: var(--Colors-Primary-400, #444);

            /* Global Tokens/Body/B-2 */
            font-family: Oswald;
            font-size: 15px;
            font-style: normal;
            font-weight: 400;
            line-height: 24px;
            /* 150% */
        }

        .news-text {
            color: var(--Colors-Primary-500, #1F1F1F);
            font-size: 17px;
            font-style: normal;
            font-weight: 400;
            line-height: 27px;
            /* 150% */
        }

        .news-link {
            color: var(--Colors-Primary-500, #1F1F1F);

            /* Global Tokens/Headings/H-7 */
            font-size: 20px;
            font-style: normal;
            font-weight: 700;
            line-height: 33px;
            /* 150% */
        }
        .new img{
            border-radius: var(--Radius-8, 20px);

        }
    </style>
@endsection
@section('content')
    <section class="products my-5">
        <div class="container">
            <div class="mb-4">
                <span class="muted-color">Home</span> / <span class="black-color">Smart Use Guides </span>
            </div>

            <div class="news">

                @foreach($useGuides as $useGuide)
                <div class="my-4 row new main-border-bottom">
                    <div class="col-md-6 col-12 mb-3" style="justify-content: space-between;display: flex;flex-direction: column;">
                        <div>

                            <div class="news-title">{{ $useGuide->title }}</div>
                            <div class="news-date my-3">Posted on {{ $useGuide->created_at->format('F d, Y') }} by beshir</div>
                        </div>
                        <div class="news-text mb-3"></div>
                        <a href="{{ route("web.use_guides.show",$useGuide->id ) }}" class="news-link">
                            <span class="bold black-color"> Read </span> <i class="mx-2 fa-solid fa-arrow-up fa-rotate-90"></i>
                        </a>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <img src="{{ asset('storage/'. $useGuide->thumbnail) }}" style="height: 250px" class="max-width" loading="lazy" alt="">
                    </div>
                </div>
                @endforeach
                {{-- @for($i= 0 ;$i<3 ; $i++)
                <div class="my-4 row new main-border-bottom">
                    <div class="col-md-6 col-12 mb-3">
                        <div class="news-title">Al-Kassem Engineering Industries Group Hosts Juthoor Association and Children
                            with Love Syndrome</div>
                        <div class="news-date my-3">Posted on May 26, 2024 by beshir</div>
                        <div class="news-text mb-3">
                            As part of its commitment to social responsibility and the integration of people with special
                            needs
                            into society, Al-Kassem Engineering Industries Group hosted the Juthoor Association and its
                            children
                            with Love Syndrome at its industrial facility in the Adar Industrial Zone
                        </div>
                        <a href="{{ route("web.use_guides.show",1) }}" class="news-link">
                            <span class="bold black-color"> Read </span> <i class="mx-2 fa-solid fa-arrow-up fa-rotate-90"></i>
                        </a>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <img src="{{ asset('static/news.webp') }}" class="max-width" loading="lazy" alt="">
                    </div>
                </div>
                @endfor --}}

            </div>
        </div>
    </section>
@endsection
@section('js')

@endsection
