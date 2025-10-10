@extends('web.app')
@section('title', 'Ramco | Home Appliances')
@section('css')
    <style>
        .category-btn {
            transition: ease-in 0.3s;
            border-radius: var(--12, 12px);
            border: 1px solid var(--black-10, rgba(0, 0, 0, 0.10)) !important;
            color: var(--Colors-Primary-400, #444);
            display: flex;
            padding: var(--8, 8px) var(--16, 16px);
            justify-content: center;
            align-items: center;
            gap: var(--8, 8px);
            background: transparent;

        }

        .category-btn.active {
            background: #1F1F1F;
            color: white;
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
            max-height: 335px;
            transition: ease-in-out 0.2s;
            max-width: 100%;
            ;
        }

        .products .card {
            border-radius: var(--Radius-10, 28px);
        }
    </style>
    <style>
        .subcategory-slider {
            padding: 20px 0;
        }

        .subcategory-slider .swiper-slide {
            width: auto;
        }

        .category-btn {
            white-space: nowrap;
        }
        .swiper-slide{
            padding: 8px;
        }
    </style>

@endsection
@section('content')
    <section class="products my-5">
        <div class="container">
            <div class="mb-2">
                <span class="muted-color">Home</span> / <span class="text-black">{{ $category->name }}</span>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <div class="section-title black-color my-4">{{ $category->name }}</div>
                <div class="description ">
                    Discover RAMCO iconic range of home appliances, it includes induction cookers, washing machines water
                    dispensers and others
                </div>
            </div>
            <div class="swiper subcategory-slider">
                <div class="swiper-wrapper">
                    @foreach ($sub_categories as $sub_category)
                        <div class="swiper-slide">
                            <a href="?sub_category_id={{ $sub_category->id }}"
                                class="category-btn {{ request('sub_category_id') == $sub_category->id ? 'active' : '' }}">
                                {{ $sub_category->name }}
                            </a>
                        </div>
                    @endforeach
                </div>

            </div>


            <div class="d-flex justify-content-between align-items-center my-3">
                <div class="filters">Filters <i class="mx-2 fa-solid fa-chevron-down"></i></div>
                <div class="filters">Sort By <i class="mx-2 fa-solid fa-chevron-down"></i></div>
            </div>
            <div class="mb-3 products">
                <div class="row">
                    @forelse ($products as $product)
                        <div class="col-md-4 col-sm-6 col-12 mb-4">
                            @include('web.partials.product_card', [
                                'product' => $product,
                                'category' => $category,
                            ])

                        </div>

                    @empty
                        <div class="col-12 text-center my-5">
                            <h4 class="text-muted">No products found</h4>
                        </div>
                    @endforelse
                    {{ $products->links('vendor.pagination.custom') }}

                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')

    <script>
        const swiper = new Swiper('.subcategory-slider', {
            slidesPerView: 'auto',
            spaceBetween: 12,
            freeMode: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                320: {
                    spaceBetween:0
                },
                768: {
                    spaceBetween: 0
                }
            }
        });
    </script>
@endsection
