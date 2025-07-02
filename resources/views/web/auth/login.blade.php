@extends('web.app')
@section('title', 'Ramco')
@section('css')
<style>
    .swiper-button-prev:after, .swiper-rtl .swiper-button-next:after {
    content: 'prev';
    font-size: 20px;
    color: black;
}
.swiper-button-next:after, .swiper-rtl .swiper-button-prev:after {
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
                <div class="row align-items-center">
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
            </div>
        </section>
        

    </section>
@endsection
