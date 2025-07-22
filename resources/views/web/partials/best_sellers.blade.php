{{-- best_sellers.blade.php --}}

@if (count($products) > 0)

@foreach ($products as $product)
    <div class="swiper-slide">
        @include('web.partials.product_card', ['product' => $product])

    </div>
@endforeach
@else
       <div class="swiper-slide w-100 text-center py-5">
        <h4>No products found</h4>
    </div>
@endif