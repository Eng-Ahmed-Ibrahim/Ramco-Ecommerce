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
