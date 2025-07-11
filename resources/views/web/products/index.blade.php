@extends('web.app')
@section('title', 'Ramco | Home Appliances')
@section('css')
    <style>
        .category-btn {
            transition: ease-in 0.3s;
            border-radius: var(--12, 12px);
            border: 1px solid var(--black-10, rgba(0, 0, 0, 0.10));
            display: flex;
            padding: var(--8, 8px) var(--16, 16px);
            justify-content: center;
            align-items: center;
            gap: var(--8, 8px);
            background: transparent;

        }

        .active {
            /* background: var(--Colors-Primary-500, #1F1F1F); */
            color: #fff;
        }

        .category-btn:hover {
            background: var(--Colors-Primary-500, #1F1F1F);
            color: #fff;
        }

        .filters {
            color: var(--Colors-Primary-400, #444);
            text-align: center;

            /* Global Tokens/Body/B-2 */
            font-size: 15px;
            font-style: normal;
            font-weight: 400;
            line-height: 24px;
            /* 150% */
        }

        .description {
            width: 30%;
        }

        @media (max-width: 425px) {
            .description {
                width: 100%;
            }
        }

        .products .product img {
            height: 335px;
            transition: ease-in-out 0.2s ;
        }

        .products .card {
            border-radius: var(--Radius-10, 28px);
        }


        .products .product img:hover{
            transform: scale(1.2);
        }
    </style>
@endsection
@section('content')
    <section class="products my-5">
        <div class="container">
            <div class="mb-2">
                <span class="muted-color">Home</span> / <span>Home Appliances </span>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <div class="section-title black-color my-4">Home Appliances </div>
                <div class="description ">
                    Discover RAMCO iconic range of home appliances, it includes induction cookers, washing machines water
                    dispensers and others
                </div>
            </div>
            <div class="d-flex gap-3 align-items-center flex-wrap">
                @foreach($sub_categories as $sub_category)
                <button class="category-btn ">{{ $sub_category->name }}</button>
                @endforeach
            </div>
            <div class="d-flex justify-content-between align-items-center my-3">
                <div class="filters">Filters <i class="mx-2 fa-solid fa-chevron-down"></i></div>
                <div class="filters">Sort By <i class="mx-2 fa-solid fa-chevron-down"></i></div>
            </div>
            <div class="mb-3 products">
                <div class="row">
                    @forelse ($products as $product)
              
                        <div class="col-md-6  col-12 mb-3 product">
                            <div class="card">
                                <div class="card-body ">
                                    <div class="d-flex justify-content-between align-items-center my-3">
                                        <div class="d-flex gap-2">
                                            @foreach($product->colors as $color)
                                            <span class="color" style="background: {{ $color }};"></span>
                                            @endforeach
                                        </div>
                                        <i style="font-size: 20px" class="fa-regular fa-heart"></i>
                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route("web.products.show",[$product->category->slug,$product->slug]) }}">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="">
                                        </a>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span>{{ $product->name }}</span>
                                        <span>{{ $product->price }} $</span>
                                    </div>
                                    <div class="d-flex gap-3 my-3">
                                        <button class="main-btn-no-bg w-50" style="border-radius: 10.504px;">Buy
                                            Now</button>
                                        <button class="main-btn w-50" style="border-radius: 10.504px;">Add To
                                            Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center my-5">
        <h4 class="text-muted">No products found</h4>
    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')

@endsection
