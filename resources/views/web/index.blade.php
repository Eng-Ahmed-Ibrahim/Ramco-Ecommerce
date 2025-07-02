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
    </style>
@endsection
@section('content')
    <section class="home mb-5">

        <section class="hero mb-5">
            <div class="container py-5">
                <div class="row align-items-center desktop">
                    <div class="col-md-6 col-sm-12 mb-3">
                        <span class="hero-text">UNLEASH THE POWER With Blender RB-663 </span>
                    </div>
                    <div class="col-md-6 col-sm-12 mb-3">
                        <div class="d-md-flex d-block text-md-start text-center align-items-center ">

                            <img src="{{ asset('static/hero_image.png') }}" class="mb-3" alt="">
                            <div>

                                <div class="mb-3 hero-content">
                                    ? 5-Speeds Control | ❄️ Ice-Crushing Magic
                                    ? 1.5 liters Jar Capacity | ☕️ Coffee & Spices grinder
                                    ⚙️ Powerful 17,000 RPM
                                </div>
                                <button class="main-btn">View details</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center mobile-flex">
                    <div class="col-6 mb-3">
                        <span class="hero-text">UNLEASH THE POWER With Blender RB-663 </span>
                        <div>

                            <div class="my-3 hero-content">
                                ? 5-Speeds Control | ❄️ Ice-Crushing Magic
                                ? 1.5 liters Jar Capacity | ☕️ Coffee & Spices grinder
                                ⚙️ Powerful 17,000 RPM
                            </div>
                            <button class="main-btn">View details</button>
                        </div>
                    </div>
                    <div class="col-6 mb-3">

                            <img src="{{ asset('static/hero_image.png') }}" class="mb-3 max-width" alt="">

                    </div>
                </div>
            </div>
        </section>

        <section class="best_products mb-5">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-md-6 col-12 section-title">
                        Find the best <span class="main-color">Ramco</span>
                        product for every need
                    </div>
                </div>
                <div class="swiper-container position-relative" style="overflow: hidden;">
                    <div class="swiper-wrapper products">
                        @for ($i = 0; $i < 10; $i++)
                            @php
                                $imageNumber = ($i % 3) + 1; // بيكرر 1،2،3 ثم يرجع تاني
                                $index = $i % 3;
                            @endphp
                            @php
                                $names = ['Blender', 'Washing Machine', 'Stand Mixer'];
                                $descriptions = [
                                    'Enjoy a variety of smoothies and refreshing beverages',
                                    'Experience various washing cycles and efficient cleaning',
                                    'Explore different mixing speeds and effective blending',
                                ];
                            @endphp
                            <div class="swiper-slide product">
                                <div class="mb-4">
                                    <div class="product-name">{{ $names[$index] }}</div>
                                    <div class="product-description">{{ $descriptions[$index] }}</div>
                                </div>
                                <img src="{{ asset('static/product' . $imageNumber . '.png') }}" loading="lazy"
                                    alt="Product {{ $imageNumber }}">
                            </div>
                        @endfor
                    </div>

                    <!-- ✅ Row: See All | Scrollbar | Arrows -->
                    <div class="d-flex justify-content-between align-items-center mt-3 gap-3 ">

                        <!-- ✅ See All -->
                        <a href="#" class="see-all-link text-decoration-none fw-bold" style="white-space: nowrap;">See
                            All</a>
                        <div class="swiper-scrollbar" style="height: 6px;"></div>
                        <div class="d-flex align-items-center ">

                            <div class="swiper-button-prev mx-3" style="position: relative;top:10px;"></div>
                            <div class="swiper-button-next" style="position: relative;top:10px;"></div>
                        </div>

                    </div>
                </div>

        </section>

        <section class="video-section mb-5 row justify-content-around align-items-center">
            <video autoplay muted loop playsinline class="bg-video">
                <source src="{{ asset('static/video.mp4') }}" type="video/mp4">
                Your browser does not support HTML5 video.
            </video>

            <div class="video-content col-md-4 col-sm-6 col-12">
                <div class="container mx-4 mx-md-auto">

                    <div class="video-title">KASEM GROUP</div>
                    <p class="video-content">Renowned engineering company,
                        established in 1993, specializing in
                        electric household appliances.

                        With a wide range of over fifty products,
                        we focus on maintaining high quality, satisfying
                        individual customer needs, and
                        providing exceptional after-sales service.

                        Our vision revolves around building strong
                        relationships with customers through
                        trust and partnership. Operating in
                        Damascus, Syria, and beyond, Kasem
                        Group strives to empower homes with
                        innovative solutions and reliable
                        appliances.</p>
                </div>
            </div>
            <div class="col-4"></div>
        </section>

        <section class="mb-5 best_seller ">
            <div class="container">
                <div class="section-title mb-4">Best Sellers</div>
                <div class="row">


                    @for ($i = 0; $i < 3; $i++)
                        @php
                            $imgNumber = ($i % 3) + 4;
                            $productsNames = ['Induction Cooker', 'Iron RST-870', 'Hair Dryer'];

                        @endphp
                        <div class="col-md-4 col-sm-6 col-12 mb-3">
                            <div class="card">
                                <div class="card-body ">
                                    <div class="text-end my-3">
                                        <i style="font-size: 20px" class="fa-regular fa-heart"></i>
                                    </div>
                                    <div class="text-center">
                                        <img src="{{ asset('static/product' . $imgNumber . '.png') }}" alt="">
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <span>{{ $productsNames[$i] }}</span>
                                        <span>27 $</span>
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
                    @endfor


                </div>
            </div>
        </section>

        <section class="best-deal mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <img src="{{ asset('static/best_deal.webp') }}" class="max-width"  >
                    </div>
                    <div class="col-md-1 col-12"></div>
                    <div class="col-md-5 col-12 d-flex flex-column justify-content-between mb-3">
                        <div class="best-deal-title">
                            <span class="main-color">Ramco</span> Water Cooler Overwhelm by freshness
                        </div>

                        <p class="best-deal-content my-4">
                            Introducing the latest water cooler that blends modern technology with classic design,
                            offering refreshing hydration at the touch of a button. This appliance provides chilled or
                            hot water options while incorporating energy-saving features to reduce your carbon
                            footprint.
                        </p>
                        <div>
                            <a href="">Discover More <i class="fa-solid fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="help ">
            <div class="container">

                <div class="mb-5">
                    <div class="section-title">Need Help?</div>
                    <p>We're here to provide all the help you need</p>
                </div>
                <div class="row">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="col-md-4 col-sm-6 col-12 mb-3">
                            <div class="card pt-5 pb-3 px-2 " style="border-radius:24px;">
                                <div class="card-body">

                                    <div class="row align-items-center mb-5">
                                        <div class=" col-8">
                                            <div class="title mb-3">Repair request</div>
                                            <div class="description">Request repair service Conveniently online</div>
                                        </div>
                                        <div class=" col-4">
                                            <img src="{{ asset('static/icon1.svg') }}" alt="">
                                        </div>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60"
                                        viewBox="0 0 83 83" fill="none">
                                        <path
                                            d="M37.8051 24.3042C36.6845 23.2038 34.884 23.2202 33.7836 24.3408C32.6832 25.4613 32.7004 27.2625 33.8208 28.3629L33.8255 28.3676L33.8469 28.3887L33.9359 28.4768C34.015 28.5554 34.1327 28.6729 34.2834 28.8247C34.5851 29.1285 35.0185 29.5693 35.5395 30.1115C36.5841 31.1984 37.9694 32.6808 39.348 34.2768C40.7368 35.8846 42.0698 37.5514 43.0397 39.015C43.5254 39.7479 43.8817 40.3729 44.1075 40.8724C44.2709 41.2338 44.3216 41.4334 44.3371 41.5C44.3216 41.5667 44.2709 41.7663 44.1075 42.1276C43.8817 42.6272 43.5254 43.2521 43.0397 43.985C42.0698 45.4486 40.7368 47.1154 39.348 48.7231C37.9694 50.3191 36.5841 51.8014 35.5395 52.8883C35.0184 53.4305 34.5851 53.8713 34.2834 54.1751C34.1326 54.3269 34.0149 54.4444 33.9358 54.523L33.8469 54.6111L33.8254 54.6322L33.8198 54.6378C32.6994 55.7382 32.6831 57.5385 33.7835 58.659C34.8839 59.7797 36.6848 59.7956 37.8054 58.6952L37.8085 58.6922L37.8434 58.6577L37.9447 58.5574C38.0322 58.4704 38.1589 58.344 38.3192 58.1826C38.6396 57.8599 39.0949 57.3968 39.6402 56.8294C40.7285 55.697 42.1869 54.1371 43.652 52.441C45.107 50.7567 46.6177 48.8817 47.7807 47.1268C48.3614 46.2505 48.8937 45.3471 49.29 44.4708C49.6635 43.6445 50.0313 42.5966 50.0313 41.5C50.0312 40.4035 49.6635 39.3556 49.2899 38.5293C48.8937 37.653 48.3614 36.7495 47.7807 35.8732C46.6177 34.1184 45.107 32.2433 43.6521 30.5589C42.187 28.8628 40.7286 27.3029 39.6403 26.1705C39.095 25.6031 38.6397 25.14 38.3193 24.8173C38.159 24.6559 38.0323 24.5295 37.9448 24.4425L37.8435 24.3421L37.8162 24.3152L37.8051 24.3042Z"
                                            fill="#444444" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M41.5 0.739502C18.9887 0.739502 0.739594 18.9886 0.739594 41.4999C0.739594 64.0113 18.9887 82.2603 41.5 82.2603C64.0114 82.2603 82.2604 64.0113 82.2604 41.4999C82.2604 18.9886 64.0114 0.739502 41.5 0.739502ZM6.42709 41.4999C6.42709 22.1297 22.1298 6.427 41.5 6.427C60.8702 6.427 76.5729 22.1297 76.5729 41.4999C76.5729 60.8702 60.8702 76.5728 41.5 76.5728C22.1298 76.5728 6.42709 60.8702 6.42709 41.4999Z"
                                            fill="#444444" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>


        </section>


    </section>
@endsection
@section('js')
    <script>
        const swiper = new Swiper('.swiper-container', {
            spaceBetween: 16,
            freeMode: true,
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            scrollbar: {
                el: '.swiper-scrollbar',
                draggable: true,
                hide: false,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            // ✅ Responsive behavior
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                576: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 3,
                },
            },
        });
    </script>
@endsection
