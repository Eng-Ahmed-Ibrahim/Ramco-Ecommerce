<style>
    .cart-count {
    position: absolute;
    top: -6px;
    left: -20px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
    font-weight: bold;
    min-width: 18px;
    height: 18px;
    text-align: center;
    line-height: 14px;
    transform: translate(50%, -50%);
    z-index: 10;
}
@media (max-width: 768px) {
    .mobile {
        display: block;
    }
    .cart-count{
            left: 0;
    }
}
.navbar-brand{
    margin: 0;
}

</style>
<nav class="navbar navbar-expand-lg px-md-5 p-md-4 p-2 py-4">
    <div class="container-fluid d-flex align-items-center  gap-2 p-0">
        <button class="navbar-toggler" type="button" style="border: none" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="mobile">
            <span>En</span>
            <i class="fas fa-globe"></i>
        </div>
        <a class="navbar-brand" href="{{ route('web.pages.home') }}"><img class="logo"
                src="{{ asset('static/logo_header_f1.png') }}" alt=""></a>

        {{-- Cart & User  --}}
        <div class="mobile mx-2">
            <a href="{{ route('web.cart.index') }}" style="position: relative">
                <span  class="cart-count">{{ $siteSettings['cart_count'] }}</span>
                <i class="fa fa-shopping-cart icon mx-4"></i>
            </a>
            <a href="{{ route('web.auth.login') }}">
                <i class="fas fa-user mx-2"></i>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="mobile mt-3">
                <form role="search">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="search" class="form-control search-input w-100"
                            style="background: transparent;border: 1px solid rgba(0, 0, 0, 0.40);"
                            placeholder="Search" />
                    </div>
                </form>
            </div>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('web.pages.about') }}">About Us </a>
                </li>

                @foreach ($siteSettings['categories'] as $category)
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('web.products.index', $category->slug) }}">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach

                {{-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('web.products') }}#"> Kitchen
                        Appliances </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('web.products') }}">Home Appliances
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('web.products') }}">Accessories </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('web.repair') }}">Repair </a>
                </li>
       
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('web.contact') }}">Contact Us </a>
                </li>

            </ul>
            <div class=" align-items-center gap-3 desktop" style="display: flex;">

                <form role="search">
                    <div class="search-container">
                        <i class="fas fa-search search-icon"></i>
                        <input type="search" class="form-control search-input" placeholder="Search" />
                    </div>
                </form>

                <span>English</span>
                <i class="fas fa-globe"></i>
                <a href="{{ route('web.cart.index') }}" style="position: relative">
                    <span class="cart-count">{{ $siteSettings['cart_count'] }}</span>

                    <i class="fa fa-shopping-cart icon"></i>
                </a>

                <a href="{{ route('web.auth.login') }}">
                    <i class="fas fa-user"></i>
                </a>
            </div>

        </div>
    </div>
</nav>
