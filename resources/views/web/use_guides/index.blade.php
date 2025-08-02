@extends('web.app')
@section('title', 'Ramco | Smart Use Guides')
@section('css')
    <style>
        .news-title {
            color: var(--Colors-Primary-500, #1F1F1F);
            font-size: 19px;
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

        .new img {
            border-radius: var(--Radius-8, 20px);

        }

        @media (max-width: 425px) {

            .news img {
                max-height: 350px;
                width: 100% !important;
            }
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

                <div class="my-4 row">
                    @foreach ($useGuides as $useGuide)
                        <a href="{{ route('web.use_guides.show', $useGuide->id) }}" class="col-md-3 col-sm-6 col-12 mb-3">


                            <img src="{{ asset('storage/' . $useGuide->thumbnail) }}"
                                style="height: 250px;border-radius: 40px;" class="max-width" loading="lazy" alt="">
                            <div class="news-title"> {{ \Illuminate\Support\Str::limit($useGuide->title, 50) }}</div>


                        </a>
                    @endforeach
                </div>


            </div>
        </div>
    </section>
@endsection
@section('js')

@endsection
