<div class="mb-3">
    <label>Name *</label>
    <input name="name" class="form-control" required value="{{ old('name', $branch->name ?? '') }}">
</div>

<div class="mb-3">
    <label>Office Address</label>
    <input name="office_address" class="form-control" value="{{ old('office_address', $branch->office_address ?? '') }}">
</div>

<div class="mb-3">
    <label>Office Tel</label>
    <input name="office_tel" class="form-control" value="{{ old('office_tel', $branch->office_tel ?? '') }}">
</div>

<div class="mb-3">
    <label>Office Fax</label>
    <input name="office_fax" class="form-control" value="{{ old('office_fax', $branch->office_fax ?? '') }}">
</div>

<div class="mb-3">
    <label>Mobile/WhatsApp</label>
    <input name="mobile_whatsapp" class="form-control" value="{{ old('mobile_whatsapp', $branch->mobile_whatsapp ?? '') }}">
</div>

<div class="mb-3">
    <label>Office Email</label>
    <input name="office_email" class="form-control" type="email" value="{{ old('office_email', $branch->office_email ?? '') }}">
</div>

<div class="mb-3">
    <label>Factory Address</label>
    <input name="factory_address" class="form-control" value="{{ old('factory_address', $branch->factory_address ?? '') }}">
</div>

<div class="mb-3">
    <label>Factory Tel</label>
    <input name="factory_tel" class="form-control" value="{{ old('factory_tel', $branch->factory_tel ?? '') }}">
</div>

<div class="mb-3">
    <label>Factory Email</label>
    <input name="factory_email" class="form-control" type="email" value="{{ old('factory_email', $branch->factory_email ?? '') }}">
</div>
