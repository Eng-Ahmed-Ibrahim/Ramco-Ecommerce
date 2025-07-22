    <style>
        .product-card {
            background-size: cover;
            background-position: center;
            aspect-ratio: 1/1;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            border-radius: 10px 10px 0 0;
        }

        .product-overlay {
            padding: 1rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: rgba(0, 0, 0, 5%);
            color: white;
        }

        .color-dot {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            border: 2px solid #fff;
            cursor: pointer;
        }

        .product-info {
            background-color: #f8f9fa;
            /* نفس خلفية الـ body */
            padding: 1rem;
            border-radius: 0 0 10px 10px;
            text-align: center;
        }

        .product-name {
            font-weight: bold;
            font-size: 1.1rem;
            color: #333;
        }

        .price {
            font-size: 1rem;
            color: #555;
        }

        .btn-group-custom {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 0.5rem;
        }
    </style>
    @php  
    $category = $category ?? $product->category;
    @endphp
    <a href="{{ route('web.product.show',[$category->slug, $product->slug]) }}" class="product-card"
        style="background-image: url('{{asset('storage/' . $product->thumbnail)}}');">
        <div class="product-overlay">
            <div class="d-flex justify-content-between align-items-start">
                <div class="d-flex gap-2">
                    <span class="color-dot" style="background-color: black;"></span>
                </div>
                <i class="fa-regular fa-heart"></i>
            </div>
        </div>
    </a>
    <div class="product-info">
        <div class="d-flex align-items-center justify-content-between">
            <span class="black-color"> {{ $product->name }}</span>
            <span class="black-color">{{ $product->price }} $</span>
        </div>
        <div class="d-flex gap-3 my-3">
            <button class="main-btn-no-bg w-50" style="border-radius: 10.504px;">Buy
                Now</button>
            <button onclick="addToCart('{{ $product->id }}',null , 'selected-color', this )" class="main-btn w-50"
                style="border-radius: 10.504px;">Add To
                Cart</button>
        </div>
    </div>
