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
        .hidden-input{
                width: 0;
    height: 0;
    position: absolute;
    opacity: 0;
        }
    </style>
@endsection
@section('content')
    <section class="products my-5">
        <div class="container">
            <div class="mb-2">
                <span class="muted-color">Home</span> / <span>Repair </span>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                <div class="section-title black-color my-4">Request a repair </div>
                <div class="description ">
                    Discover RAMCO iconic range of home appliances, it includes induction cookers, washing machines water
                    dispensers and others
                </div>
            </div>

            <form  onsubmit="handleSubmit(event)"> 

                <div class="step-section step-one  " >

                    {{-- process --}}
                    <div
                        class=" mb-4 steps d-md-flex flex-column flex-md-row justify-content-center align-items-start text-start gap-md-5">
                        <div class="mb-2 d-flex align-items-center ">
                            <span class="step-number active">1</span>
                            <span class="mx-2 step-name active">Choose a product</span>
                        </div>
                        <div class="mb-2 d-flex align-items-center ">
                            <span class="step-number ">2</span>
                            <span class="mx-2 step-name">Identify Problem</span>
                        </div>
                        <div class="mb-2 d-flex align-items-center ">
                            <span class="step-number ">3</span>
                            <span class="mx-2 step-name">Enter your contact information</span>
                        </div>
                    </div>
                    {{-- search --}}
                    <div class="container mb-3">
                        <div class="search-box shadow-sm">
                            <span class="icon"><i class="fas fa-search"></i></span>
                            <input type="text" placeholder="Please type model number or keyword" readonly
                                data-bs-toggle="modal" data-bs-target="#searchModal">
                            <input type="button" value="Select Model" readonly
                                style="text-decoration: underline;    text-align: right;" data-bs-toggle="modal"
                                data-bs-target="#searchModal">
                        </div>
                    </div>
                    {{-- selected product --}}
                    <div class="text-center" style="display:flex;justify-content:center;">

                        <div class="mb-3 selected-product d-flex align-items-center justify-content-between">
                            <input type="hidden" value="1"  name="product_id" id="SelectedProductId">
                            <div class="d-flex  align-items-center gap-2">
                                <div class="product-img">
                                    <img src="{{ asset('static/product1.png') }}" alt="">
                                </div>
                                <span>Blender RB-660</span>
                            </div>
                            <input type="button" value="edit" readonly style="text-decoration: underline;"
                                data-bs-toggle="modal" data-bs-target="#searchModal">
                        </div>
                    </div>
                    {{-- form --}}
                    <div class="row">
                        <div class="col-md-6 col-12 mb-4">
                            <div class="input-wrapper">
                                <label for="branch" class="mb-2"> Branch</label>
                                <div class="input-wrapper">
                                    <i class="fa fa-building icon"></i>
                                    <input type="text" id="branch" placeholder="branch location" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <div class="input-wrapper">
                                <label for="serial_number" class="mb-2"> Serial Number</label>
                                <div class="input-wrapper">
                                    <input type="text" id="serial_number" placeholder="Serial Number" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <div class="input-wrapper" onclick="document.getElementById('date').showPicker()">
                                <label for="date" class="mb-2">Purchase Date</label>
                                <div class="input-wrapper">
                                    <input type="date" id="date" placeholder="Select date" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <div class="input-wrapper" onclick="document.getElementById('guarantee_date').showPicker()">
                                <label for="guarantee_date" class="mb-2">guarantee Date</label>
                                <div class="input-wrapper">
                                    <input type="date" id="guarantee_date" placeholder="guarantee Date" />
                                </div>
                            </div>
                        </div>

                    </div>
                    {{-- Next Button --}}
                    <div class="d-flex align-items-center justify-content-center">
                        <button onclick="nextStep('two')" type="button" style="width: 320px" class="main-btn">Next <i
                                class="fa-solid fa-chevron-down fa-rotate-270"></i></button>
                    </div>
                </div>
                <div class="step-section step-two d-none">
                    {{-- process --}}
                    <div class=" mb-4 steps d-md-flex flex-column flex-md-row justify-content-center align-items-start text-start gap-md-5">
                        <div class="mb-2 d-flex align-items-center ">
                            <span class="step-number ">1</span>
                            <span class="mx-2 step-name ">Choose a product</span>
                        </div>
                        <div class="mb-2 d-flex align-items-center ">
                            <span class="step-number active ">2</span>
                            <span class="mx-2 step-name active">Identify Problem</span>
                        </div>
                        <div class="mb-2 d-flex align-items-center ">
                            <span class="step-number ">3</span>
                            <span class="mx-2 step-name">Enter your contact information</span>
                        </div>
                    </div>
                    {{-- form --}}
                    <div class="mb-3">
                        <label for="issue" class="mb-2">Select the Issue</label>
                        <select id="issue" class="w-100" name="issue" id="">
                            <option selected disabled>Select</option>
                            @for ($i = 0; $i < 5; $i++)
                                <option value="Unusual Noise">Unusual Noise</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="mb-2">Description</label>
                        <textarea name="description" id="description" placeholder="Describe the issue, e.g., noises, error codes"
                            class="w-100"></textarea>
                    </div>
                    {{-- Next Button --}}
                    <div class="d-flex align-items-center justify-content-center">
                        <button onclick="nextStep('three')" type="button" style="width: 320px" class="main-btn">Next <i
                                class="fa-solid fa-chevron-down fa-rotate-270"></i></button>
                    </div>
                </div>
                <div class="step-section step-three d-none">

                    {{-- process --}}
                    <div class=" mb-4 steps d-md-flex flex-column flex-md-row justify-content-center align-items-start text-start gap-md-5">
                        <div class="mb-2 d-flex align-items-center ">
                            <span class="step-number ">1</span>
                            <span class="mx-2 step-name ">Choose a product</span>
                        </div>
                        <div class="mb-2 d-flex align-items-center ">
                            <span class="step-number  ">2</span>
                            <span class="mx-2 step-name ">Identify Problem</span>
                        </div>
                        <div class="mb-2 d-flex align-items-center ">
                            <span class="step-number  active">3</span>
                            <span class="mx-2 step-name active">Enter your contact information</span>
                        </div>
                    </div>
                    {{-- form --}}
                    <div class="row">
                        <div class="col-md-6 col-12 mb-4">
                            <div class="input-wrapper">
                                <label for="name" class="mb-2"> Full Name</label>
                                <div class="input-wrapper">
                                    <input type="text" id="name" placeholder="Full Name" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <div class="input-wrapper">
                                <label for="contact_number" class="mb-2"> Contact Number</label>
                                <div class="input-wrapper">
                                    <input type="text" id="contact_number" placeholder="Contact Number" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <div class="input-wrapper"
                                onclick="document.getElementById('visit_request_date').showPicker()">
                                <label for="visit_request_date" class="mb-2">Visit Request Date</label>
                                <div class="input-wrapper">
                                    <input type="date" id="visit_request_date" placeholder="Select date" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <div class="input-wrapper" onclick="document.getElementById('time_schedule').showPicker()">
                                <label for="time_schedule" class="mb-2">Time schedule</label>
                                <div class="input-wrapper">
                                    <input type="time" id="time_schedule" placeholder="Select Time" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <div class="input-wrapper">
                                <label for="email" class="mb-2"> Email Address</label>
                                <div class="input-wrapper">
                                    <input type="email" id="email" placeholder="Please enter a valid email" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <div class="input-wrapper">
                                <label for="address" class="mb-2">  Address</label>
                                <div class="input-wrapper">
                                    <input type="text" id="address" placeholder="branch location" />
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Next Button --}}

                    <div class="d-flex align-items-center justify-content-center">
                        <button   type="submit" style="width: 320px" class="main-btn">Submit Request </button>
                    </div>
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
                    <input type="text" class="form-control border-0 shadow-sm" placeholder="Search product..."
                        style="box-shadow: none !important;">
                </div>

                <!-- Product List -->
                <div class="list-group">
                    <div class="d-flex justify-content-between align-items-center product-item list-group-item">
                        <span>Blender RB-660</span>
                        <small class="text-muted">Blenders</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center product-item list-group-item">
                        <span>Washing Machine 10kg - Grey - Model WM-WP0106</span>
                        <small class="text-muted">Washing Machines</small>
                    </div>
                    <div class="d-flex justify-content-between align-items-center product-item list-group-item">
                        <span>Vacuum Cleaner RV-Z070</span>
                        <small class="text-muted">Vacuum Cleaners</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
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

        // Submit the form (you can use form.submit(), AJAX, or anything else)
        alert("Form is valid and ready to submit!");
    }
</script>

@endsection
