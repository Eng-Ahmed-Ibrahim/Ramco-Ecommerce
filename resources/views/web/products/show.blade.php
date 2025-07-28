@extends('web.app')
@section('title', 'Ramco | Product Details ')
@section('css')
    <style>
        .product-name {
            color: var(--Colors-Primary-500, #1F1F1F);
            font-size: 38px;
            font-style: normal;
            font-weight: 700;
            line-height: 57px;
        }

        .swiper-container-wrapper {
            position: relative;
            width: 100vw;
            left: 50%;
            transform: translateX(-50%);
        }

        .swiper {
            width: 100%;
            overflow: visible;
        }

        .swiper-slide {
            display: flex;
            justify-content: center;
            align-items: center;
            transition: transform 0.3s ease-in-out;
            aspect-ratio: 3 / 1;
            height: 400px;
        }
        @media (max-width: 768px) {
        .swiper-slide{
            height: 350px;
        }
        }


        .product-details {
            padding-left: 0;
            padding-right: 0;
        }

        .swiper-slide.swiper-slide-prev {
            display: flex;
            align-items: flex-start;

        }
        .swiper-slide.swiper-slide-next {
            display: flex;
            align-items: flex-end;

        }
        .title {
            color: var(--Colors-Primary-500, #1F1F1F);
            font-size: 30px;
            font-style: normal;
            font-weight: 500;
            line-height: 48px;
            /* 150% */
        }

        .detail {
            color: var(--Colors-Primary-400, #444);
            font-size: 18px;
            font-style: normal;
            font-weight: 400;
            line-height: 33px;
        }

        .number {
            color: var(--Colors-Primary-100, #B4B4B4);
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 33px;
            margin-right: 5px;
        }

        .feature {
            color: var(--Colors-Primary-400, #444);
            font-size: 20px;
            font-style: normal;
            font-weight: 400;
            line-height: 33px;
        }

        .sub-title {
            color: var(--Colors-Primary-400, #444);
            font-size: 18px;
            font-style: normal;
            font-weight: 400;
            line-height: 33px;
        }

        .card .card-body .text-muted {
            color: var(--Colors-Primary-100, #B4B4B4) !important;
            font-size: 12px;
            font-style: normal;
            font-weight: 600;
            line-height: 18px;
        }

        input {
            background: transparent;
            border: none;
            outline: none;
            text-align: center
        }

        .card img {
            height: 172px;
        }
    </style>

    <style>
        .zoom-container {
            overflow: hidden;
            position: relative;
            width: 100%;
        }

        .zoom-container img {
            transition: transform 0.3s ease, transform-origin 0.3s ease;
            transform: scale(1);
        }

        .zoom-container:hover img {
            transform: scale(2);
            cursor: zoom-in;
        }

        .zoom-image {
            transition: transform 0.3s ease;
        }

        .zoom-image:hover {
            transform: scale(1.2);
            cursor: zoom-in;
        }

        .zoom-container {
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .zoom-container img {
            transition: all 0.3s ease;
            width: 100%;
            height: 350px;
        }

        .zoom-container:hover img {
            width: 120%;
            /* يكبر العرض */
            height: 350px;
            cursor: zoom-in;
        }


    </style>



@endsection
@section('content')
    <section class="product-details my-5">
        <div class="container ">
            <div class="mb-4 ">
                <span class="muted-color">Home / </span> <span class="muted-color">{{ $product->category->name }} / </span>
                <span class="text-black">{{ $product->name }} </span>
            </div>
            <div class="  my-2 d-flex justify-content-between align-items-center">
                <div class="product-name">{{ $product->name }}</div>
                <i style="font-size: 20px" class="fa-regular fa-heart"></i>
            </div>
            <div class="row">

                <div class="mb-4 col-md-8 col-12">
                    {{ $product->description }}
                </div>
            </div>


        </div>
        <!-- Swiper -->
        <div class="swiper-container-wrapper">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($product->galleries as $index => $img)
                        <div class="card swiper-slide zoom-bg {{ $index === 0 ? 'align-top' : '' }}"
                            style="background-image:url('{{ asset('storage/' . $img->image) }}'); 
                            background-size: cover; 
                            background-repeat: no-repeat; 
                            background-position: center;">
              
                        </div>
                    @endforeach

                </div>
            </div>

        </div>

        <div class="container my-5">
            <div class="title mb-3">Details</div>
            @foreach (preg_split("/\r\n|\n|\r/", $product->details) as $line)
                @if (trim($line) !== '')
                    <div class="main-border-bottom py-2  d-flex align-items-center justify-content-between">
                        {{ $line }}
                    </div>
                @endif
            @endforeach

            <div class="features  my-5">

                <div class="title mb-2">Features</div>


                @foreach ($features as $index => $feature)
                    <div class=" feature main-border-bottom p-2  d-flex align-items-center justify-content-between">
                        <div style="font-size: 18px">
                            <span class="number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            {{ $feature->key }}
                        </div>
                        <div style="font-size: 16px;text-align:right;">{{ $feature->value }}</div>
                    </div>
                @endforeach
                <div class=" feature main-border-bottom p-2  d-flex align-items-center justify-content-between">
                    <div>
                        <span class="number"> {{ str_pad(count($features) + 1, 2, '0', STR_PAD_LEFT) }}</span>Color
                    </div>
                    <div class="d-flex gap-2">
                        @foreach ($product->colors as $color)
                            <span class="color" style="background: {{ $color }};"></span>
                        @endforeach
                    </div>
                </div>


            </div>

            <div class="card mb-5" style="border-radius: 20px">
                <div class="card-body p-md-5 p-3">
                    <div class="title my-3">Choose Options</div>
                    <div class="row">
                        <div class="col-md-4 col-12 mb-4 d-flex align-items-center justify-content-between">

                            <div>
                                <div class="sub-title mb-2"> Color:</div>
                                <div class="d-flex gap-2" id="color-options">
                                    @foreach ($product->colors as $color)
                                        <span class="color"
                                            style="background: {{ $color }}; width: 30px; height: 30px; border-radius: 50%; cursor: pointer; border: 2px solid #ccc;"
                                            data-color="{{ $color }}"></span>
                                    @endforeach
                                </div>
                                <input type="hidden" id="selected-color" value="">
                            </div>
                            <div>
                                <div class="sub-title mb-2"> Price: {{ $product->price }} $</div>
                                <div class="text-muted"> Include Taxes*</div>
                            </div>
                        </div>

                        <div
                            class="col-md-8 col-12 mb-3 d-flex  gap-2   align-items-center justify-content-md-around justify-content-between">
                            <div class="d-flex gap-3 align-items-center">
                                <button type="button" class="main-btn-no-bg" id="plusBtn">
                                    <i class="fa-solid fa-plus"></i>
                                </button>

                                <input type="text" name="quantity" id="product-show-quantity" value="1"
                                    min="1" readonly style="width: 60px; text-align: center;">

                                <button type="button" class="main-btn-no-bg" id="minusBtn">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            </div>
                            <button
                                onclick="addToCart('{{ $product->id }}' , 'product-show-quantity' , 'selected-color' ,this )"
                                class="main-btn w-50">Add To Cart</button>
                        </div>
                    </div>
                </div>
            </div>
            @if (count($relatedProducts) > 0)
                <div class="mb-4">
                    <div class="title my-4">You Might Also Be Interested </div>
                    <div class="row">


                        @foreach ($relatedProducts as $relatedProduct)
                            <div class="col-md-4 col-sm-6 col-12 mb-3">

                                @include('web.partials.product_card', [
                                    'product' => $relatedProduct,
                                    'category' => $product->category,
                                ])

                            </div>
                        @endforeach


                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
@section('js')
    {{-- <script>
        document.querySelectorAll('.zoom-container').forEach(container => {
            const img = container.querySelector('img');

            container.addEventListener('mousemove', function(e) {
                const rect = container.getBoundingClientRect();
                const x = ((e.clientX - rect.left) / rect.width) * 100;
                const y = ((e.clientY - rect.top) / rect.height) * 100;
                img.style.transformOrigin = `${x}% ${y}%`;
            });

            container.addEventListener('mouseleave', function() {
                img.style.transformOrigin = 'center center';
            });
        });
    </script> --}}


    <script>
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 10,
            centeredSlides: true,
            loop: true,
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 3,
                },
            }
        });
    </script>
    <script>
        const plusBtn = document.getElementById('plusBtn');
        const minusBtn = document.getElementById('minusBtn');
        const quantityInput = document.getElementById('quantity');

        plusBtn.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            quantityInput.value = currentValue + 1;
        });

        minusBtn.addEventListener('click', () => {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        });
    </script>
    <script>
        document.getElementById('plusBtn').addEventListener('click', function() {
            let input = document.getElementById('product-show-quantity');
            let current = parseInt(input.value) || 1;
            input.value = current + 1;
        });

        document.getElementById('minusBtn').addEventListener('click', function() {
            let input = document.getElementById('product-show-quantity');
            let current = parseInt(input.value) || 1;
            if (current > 1) {
                input.value = current - 1;
            }
        });
    </script>
    <script></script>

@endsection
