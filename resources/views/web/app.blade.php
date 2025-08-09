<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Ramco')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <link rel="stylesheet" href="{{ asset('css/main.css') }}?v={{ filemtime(public_path('css/main.css')) }}">

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> --}}

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.0/css/all.min.css">


    <link rel="icon" href="{{ asset('static/logo.webp') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    @yield('css')
    <style>
        .color.active {
            border: 3px solid #E2211C !important;
        }
    </style>
</head>

<body>
    @include('web.layouts.navbar')
    @yield('content')
    @include('web.layouts.footer')



    <img src="{{ asset('static/call-us.png') }}" class="customer-service" alt="Call Us">
    {{-- <img src="{{ asset('static/30-years.png') }}" class="years" alt="Call Us"> --}}

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>




    <script>
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "timeOut": "5000",
            "positionClass": "toast-top-right"
        };

        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (isset($errors) && $errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}"); @endforeach
         @endif
    </script>


    @yield('js')



    <script>
        // add. to cart function
        function addToCart(productId, quantityId = null, selectedColorId = null, button = null, buy_now = false) {
            let quantityInput = document.getElementById(quantityId);
            let quantity = quantityInput ? parseInt(quantityInput.value) : 1;
            let selectedColorInput = document.getElementById(selectedColorId);
            let selectedColor = selectedColorInput ? selectedColorInput.value : null;

            if (button) {
                button.disabled = true;
                button.innerHTML = 'Adding...';
            }

            $.ajax({
                url: "{{ route('web.cart.add_to_cart') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    quantity: quantity,
                    selectedColor: selectedColor
                },
                success: function(response) {
                    if (response.status === false) {
                        toastr.error(response.message || 'This product is already in your cart.');
                    } else {
                        let cartCounters = document.querySelectorAll('.cart-count');

                        cartCounters.forEach(function(cartNumber) {
                            let currentCount = parseInt(cartNumber.textContent) || 0;
                            cartNumber.textContent = currentCount + 1;
                        });
                        toastr.success(response.message || 'Product added to cart successfully!');
                        if (buy_now) {
                            window.location.href = '/cart';
                        }

                    }

                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON?.message || 'Something went wrong!');
                },
                complete: function() {
                    if (button) {
                        button.disabled = false;
                        button.innerHTML = 'Add To Cart';
                    }
                }
            });
        }


        // active color of selected product
        document.querySelectorAll('.color').forEach(function(el) {
            el.addEventListener('click', function() {
                document.querySelectorAll('.color').forEach(c => c.classList.remove('active'));
                this.classList.add('active');

                // Save selected color to hidden input
                const selectedColor = this.getAttribute('data-color');
                document.getElementById('selected-color').value = selectedColor;
            });
        });

        function DeleteItemOfCart(itemId, button = null) {
            console.log(itemId);

            if (!confirm("Are you sure you want to delete this item?")) return;

            if (button) {
                button.disabled = true;
                button.innerHTML = 'Deleting...';
            }
            $.ajax({
                url: "{{ route('web.cart.delete_item') }}",
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}",
                    item_id: itemId
                },
                success: function(response) {
                    if (response.status) {
                        toastr.success(response.message || "Item deleted successfully!");
                        // Reload the page or remove item from DOM
                        location.reload();
                    } else {
                        toastr.error(response.message || "Failed to delete item.");
                    }
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON?.message || "Something went wrong!");
                },
                complete: function() {
                    if (button) {
                        button.disabled = false;
                        button.innerHTML = 'Delete';
                    }
                }
            });
        }
    </script>




    </body>

</html>
