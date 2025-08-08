<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control" required></textarea>
</div>

<div class="mb-3">
    <input type="hidden" value="{{ request('section') }}" name="section" class="form-control" required>
</div>

<div class="mb-3">
    <label> File</label>
    <input type="file" name="icon" class="form-control" accept="image/*,video/*">
</div>
