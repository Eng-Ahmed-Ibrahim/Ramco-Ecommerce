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
        <a class="navbar-brand" href="#"><img class="logo" src="{{ asset('static/logo.webp') }}"
                alt=""></a>

        {{-- Cart & User --}}
        <div class="mobile mx-2">
            <i class="fa fa-shopping-cart icon mx-4"></i>
            <i class="fas fa-user mx-2"></i>
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
                    <a class="nav-link active" aria-current="page" href="#">About Us </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#"> Kitchen Appliances </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home Appliances </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Accessories </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Repair </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">News </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Contact Us </a>
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
                <i class="fa fa-shopping-cart icon"></i>

                <i class="fas fa-user"></i>
            </div>

        </div>
    </div>
</nav>
