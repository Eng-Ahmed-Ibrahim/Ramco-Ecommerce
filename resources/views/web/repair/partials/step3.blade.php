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
                <input type="text" id="name" name="full_name" placeholder="Full Name" />
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12 mb-4">
        <div class="input-wrapper">
            <label for="contact_number"  class="mb-2"> Contact Number</label>
            <div class="input-wrapper">
                <input type="text" name="phone" id="contact_number" placeholder="Contact Number" />
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12 mb-4">
        <div class="input-wrapper" onclick="document.getElementById('visit_request_date').showPicker()">
            <label for="visit_request_date"  class="mb-2">Visit Request Date</label>
            <div class="input-wrapper">
                <input type="date" id="visit_request_date" name="visit_request_date" placeholder="Select date" />
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12 mb-4">
        <div class="input-wrapper" onclick="document.getElementById('time_schedule').showPicker()">
            <label for="time_schedule" class="mb-2">Time schedule</label>
            <div class="input-wrapper">
                <input type="time" id="time_schedule" name="time" placeholder="Select Time" />
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12 mb-4">
        <div class="input-wrapper">
            <label for="email" class="mb-2"> Email Address</label>
            <div class="input-wrapper">
                <input type="email" id="email" name="email" placeholder="Please enter a valid email" />
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12 mb-4">
        <div class="input-wrapper">
            <label for="address" class="mb-2"> Address</label>
            <div class="input-wrapper">
                <input type="text"  name="address" id="address" placeholder="Address" />
            </div>
        </div>
    </div>
</div>
{{-- Next Button --}}

<div class="d-flex align-items-center justify-content-center">
    <button type="submit" style="width: 320px" class="main-btn">Submit Request </button>
</div>
