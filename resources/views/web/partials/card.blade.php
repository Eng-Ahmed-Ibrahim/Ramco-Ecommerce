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

    <div  class="product-card"
        style="background-image: url('{{asset('storage/' . $card->thumbnail)}}');">
        <a  href="{{ route('web.use_guides.show',$card->id) }}" class="product-overlay">
   
        </a>
    </div>
    <div class="product-info">
        <div class="d-flex align-items-center justify-content-between">
            <span class="black-color"> {{ $card->name }}</span>
        </div>
        <div class="d-flex gap-3 my-3">
            <a  href="{{ route('web.use_guides.show',$card->id) }}" class="main-btn w-50"
                style="border-radius: 10.504px;">View</a>
        </div>
    </div>
