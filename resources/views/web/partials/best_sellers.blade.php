{{-- best_sellers.blade.php --}}

@if (count($products) > 0)

@foreach ($products as $product)
    <div class="swiper-slide">
        <div class="card">
            <div class="card-body ">
                <div class="text-end my-3">
                    <i style="font-size: 20px" class="fa-regular fa-heart"></i>
                </div>
                <div class="text-center">
                    <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="" loading="lazy">
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <span class="black-color">{{ $product->name }}</span>
                    <span class="black-color">{{ $product->price }} $</span>
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
@endforeach
@else
       <div class="swiper-slide w-100 text-center py-5">
        <h4>No products found</h4>
    </div>
@endif