@php
    $prefix = $prefix ?? '';
@endphp

<div class="mb-3">
    <label>Code</label>
    <input type="text" class="form-control" name="code" id="{{ $prefix }}coupon_code" required>
</div>
<div class="mb-3">
    <label>Type</label>
    <select class="form-control" name="type" id="{{ $prefix }}coupon_type" required>
        <option value="fixed">Fixed</option>
        <option value="percentage">Percentage</option>
    </select>
</div>
<div class="mb-3">
    <label>Value</label>
    <input type="number" step="0.01" min="0" class="form-control" name="value" id="{{ $prefix }}coupon_value" required>
</div>
<div class="mb-3">
    <label>Start At</label>
    <input type="date" class="form-control" name="start_at" id="{{ $prefix }}coupon_start_at" required>
</div>
<div class="mb-3">
    <label>End At</label>
    <input type="date" class="form-control" name="end_at" id="{{ $prefix }}coupon_end_at" required>
</div>
