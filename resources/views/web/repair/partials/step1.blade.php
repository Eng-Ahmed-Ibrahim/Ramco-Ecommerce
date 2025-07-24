{{-- process --}}
<div class=" mb-4 steps d-md-flex flex-column flex-md-row justify-content-center align-items-start text-start gap-md-5">
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
        <input type="text" placeholder="Please type model number or keyword" readonly data-bs-toggle="modal"
            data-bs-target="#searchModal">
        <input type="button" value="Select Model" readonly style="text-decoration: underline;    text-align: right;"
            data-bs-toggle="modal" data-bs-target="#searchModal">
    </div>
</div>
{{-- selected product --}}
<div class="text-center" style="display:flex;justify-content:center;">

    <div style="display: none!important" class="mb-3 selected-product d-flex align-items-center justify-content-between">
        <input type="hidden" name="product_name" id="SelectedProductId">

        <div class="d-flex align-items-center gap-2">
            <div class="product-img">
                <img id="SelectedProductImage"  alt="">
            </div>
            <span class="text-black" id="SelectedProductName"></span>
        </div>

        <input type="button" value="edit" readonly style="text-decoration: underline;" data-bs-toggle="modal"
            data-bs-target="#searchModal">
    </div>

</div>
{{-- form --}}
<div class="row">
    <div class="col-md-6 col-12 mb-4">
        <div class="input-wrapper">
            <label for="branch" class="mb-2"> Branch</label>
            <div class="input-wrapper">
                <i class="fa fa-building icon"></i>
                <input type="text" id="branch" name="branch" placeholder="branch location" />
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12 mb-4">
        <div class="input-wrapper">
            <label for="serial_number" class="mb-2"> Serial Number</label>
            <div class="input-wrapper">
                <input type="text" name="serial_number" id="serial_number" placeholder="Serial Number" />
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12 mb-4">
        <div class="input-wrapper" onclick="document.getElementById('date').showPicker()">
            <label for="date" class="mb-2">Purchase Date</label>
            <div class="input-wrapper">
                <input type="date" name="purchase_date" id="date" placeholder="Select date" />
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12 mb-4">
        <div class="input-wrapper" onclick="document.getElementById('guarantee_date').showPicker()">
            <label for="guarantee_date" class="mb-2">Guarantee Date</label>
            <div class="input-wrapper">
                <input type="date" id="guarantee_date" name="guarantee_date" placeholder="guarantee Date" />
            </div>
        </div>
    </div>

</div>
{{-- Next Button --}}
<div class="d-flex align-items-center justify-content-center">
    <button onclick="nextStep('two')" type="button" style="width: 320px" class="main-btn">Next <i
            class="fa-solid fa-chevron-down fa-rotate-270"></i></button>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productItems = document.querySelectorAll('.product-item');

        productItems.forEach(function (item) {
            item.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const image = this.dataset.image;

                // تحديث البيانات في الـ selected section
                document.getElementById('SelectedProductId').value = name;
                document.getElementById('SelectedProductName').textContent = name;
                document.getElementById('SelectedProductImage').src = image;
                document.querySelector('.selected-product').style.display='flex'
                // إغلاق المودال
                const modal = bootstrap.Modal.getInstance(document.getElementById('searchModal'));
                modal.hide();
            });
        });
    });
</script>
