@extends('web.app')
@section('title', 'Ramco | Repair ')
@section('css')
    <style>
        .description {
            width: 30%;
        }

        @media (max-width: 425px) {
            .description {
                width: 100%;
            }
        }

        .step-number.active {
            display: flex;
            width: var(--Components-Stepper-Icon-Height, 28px);
            height: var(--Components-Stepper-Icon-Height, 28px);
            justify-content: center;
            align-items: center;
            border-radius: var(--Components-Stepper-Icon-Border-Radius, 999px);
            background: var(--Colors-Primary-500, #1F1F1F);
            color: white;
            box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.05);
        }

        .step-number {
            display: flex;
            width: var(--Components-Stepper-Icon-Height, 28px);
            height: var(--Components-Stepper-Icon-Height, 28px);
            justify-content: center;
            align-items: center;
            border-radius: var(--Components-Stepper-Icon-Border-Radius, 999px);
            background: var(--Colors-Neutral-100, #FFF);

            /* Drop Shadow/xs */
            box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.05);
        }
    </style>
    <style>
        .search-box {
            border-radius: 30px;
            overflow: hidden;
            display: flex;
            align-items: center;
            border: none;
            padding: 10px;
            border-radius: var(--32, 32px);
            background: var(--white-80, rgba(255, 255, 255, 0.80));
            box-shadow: 0px 8px 40px 0px rgba(0, 0, 0, 0.10);
            backdrop-filter: blur(20px);
        }

        .search-box input {
            border: none;
            outline: none;
            flex-grow: 1;
            padding: 12px 16px;
            font-weight: bold;
        }

        .search-box .icon {
            padding-left: 16px;
            color: #555;
        }

        .search-box .select-btn {
            background: transparent;
            border: none;
            font-weight: bold;
            padding: 12px 20px;
            color: black;
            text-decoration: underline;
        }

        .modal-content {
            border-radius: 16px;
            background: #D9D9D9;
        }

        .product-item {
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
        }

        .product-item:hover {
            background-color: #ccc;
        }

        .modal-content {
            background: #D9D9D9 !important;

            border-radius: 23px !important;
        }

        .list-group-item {
            position: relative;
            display: block;
            padding: var(--bs-list-group-item-padding-y) var(--bs-list-group-item-padding-x);
            color: var(--bs-list-group-color);
            text-decoration: none;
            background-color: #D9D9D9 !important;
            border: none !important;
            margin-bottom: 5px !important;
        }

        .list-group-item:hover {
            background: var(--black-4, rgba(0, 0, 0, 0.04)) !important;
        }

        html body .input-group span,
        input {
            border: none !important;
            box-shadow: none !important;
            background: transparent !important;
        }

        .selected-product {
            display: flex;
            padding: var(--16, 16px);
            align-items: center;
            align-content: center;
            gap: 8px var(--8, 8px);
            flex-wrap: wrap;
            border-radius: var(--16, 16px);
            background: var(--Colors-Neutral-200, #E8E8E8);
            width: 350px;
        }

        .product-img {
            border-radius: 102px;
            background: white;
            /* padding: 10px; */
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-img img {
            height: 40px;

        }

        .hidden-input {
            width: 0;
            height: 0;
            position: absolute;
            opacity: 0;
        }

        .step-name,
        .step-number {
            color: black;
        }

        .hide-product {
            display: none !important;
        }
    </style>
@endsection
@section('content')
    <section class="products my-5">
        <div class="container">
            <div class="mb-2">
                <span class="muted-color">Home</span> / <span class="text-black">Repair </span>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <div class="section-title black-color my-4">Request a repair </div>
                <div class="description ">
                    Discover RAMCO iconic range of home appliances, it includes induction cookers, washing machines water
                    dispensers and others
                </div>
            </div>

            <form method="POST" action="{{ route('web.repair.store') }}" onsubmit="handleSubmit(event)">
                @csrf
                <div class="step-section step-one  ">
                    @include('web.repair.partials.step1')
                </div>
                <div class="step-section step-two d-none">
                    @include('web.repair.partials.step2')
                </div>
                <div class="step-section step-three d-none">
                    @include('web.repair.partials.step3')
                </div>


            </form>

        </div>
    </section>

    <!-- Modal Search -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content p-4">

                <!-- Search inside modal -->
                <div class="input-group mb-3">
                    <span class="input-group-text border-0"><i class="fas fa-search"></i></span>
                    <input type="text" id="productSearch" class="form-control border-0 shadow-sm"
                        placeholder="Search product..." style="box-shadow: none !important;">
                </div>

                <!-- Product List -->
                <div class="list-group" style="max-height: 300px; overflow-y: scroll;" id="productList">
                    @foreach ($products as $product)
                        <div class="d-flex justify-content-between align-items-center product-item list-group-item"
                            data-id="{{ $product->id }}" data-name="{{ $product->name }}"
                            data-image="{{ asset('storage/'. $product->thumbnail) }}" {{-- استخدم صورة المنتج الحقيقية لو عندك --}} style="cursor: pointer;">
                            <span class="product-name">{{ $product->name }}</span>
                            <small class="text-muted">{{ $product->subCategory->name }}</small>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('productSearch');

            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const query = this.value.toLowerCase();
                    const items = document.querySelectorAll('#productList .product-item');

                    items.forEach(function(item) {
                        const name = item.querySelector('.product-name').textContent.toLowerCase();
                        const subcategory = item.querySelector('small').textContent.toLowerCase();

                        if (name.includes(query) || subcategory.includes(query)) {
                            item.classList.remove('hide-product');
                        } else {
                            item.classList.add('hide-product');
                        }
                    });
                });
            }
        });
    </script>

    <script>
        function nextStep(step) {
            let valid = true;

            if (step === 'two') {
                // Step one validation
                const productId = document.getElementById('SelectedProductId').value.trim();
                const branch = document.getElementById('branch').value.trim();
                const serial = document.getElementById('serial_number').value.trim();
                const date = document.getElementById('date').value.trim();
                const guarantee = document.getElementById('guarantee_date').value.trim();

                if (!productId || !branch || !serial || !date || !guarantee) {
                    alert("Please fill all fields before going to the next step.");
                    valid = false;
                }
            }

            if (step === 'three') {
                // Step two validation
                const issue = document.getElementById('issue').value;
                const description = document.getElementById('description').value.trim();

                if (!issue || issue === "Select" || !description) {
                    alert("Please select an issue and write a description.");
                    valid = false;
                }
            }

            if (valid) {
                // Hide all steps
                document.querySelectorAll('.step-section').forEach(section => section.classList.add('d-none'));

                // Show next step
                document.querySelector('.step-' + step).classList.remove('d-none');
            }
        }

        function handleSubmit(event) {
            event.preventDefault(); // تمنع الفورم من الـ refresh

            // Final step validation
            const name = document.getElementById('name').value.trim();
            const contact = document.getElementById('contact_number').value.trim();
            const date = document.getElementById('visit_request_date').value.trim();
            const time = document.getElementById('time_schedule').value.trim();
            const email = document.getElementById('email').value.trim();
            const address = document.getElementById('address').value.trim();

            if (!name || !contact || !date || !time || !email || !address) {
                alert("Please fill all fields before submitting.");
                return;
            }
            event.target.submit();

        }
    </script>

@endsection
