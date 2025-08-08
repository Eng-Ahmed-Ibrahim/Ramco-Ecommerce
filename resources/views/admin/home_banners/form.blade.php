<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
    <label>Sub Title</label>
    <input type="text" name="sub_title" class="form-control" required>
</div>

<div class="mb-3">
    <label>Description</label>
    <textarea name="description" class="form-control" rows="3" required></textarea>
</div>

<div class="mb-3">
    <label>Link</label>
    <input type="text" name="link" class="form-control" required>
</div>

<div class="mb-3">
    <label>Background</label>
    <input type="file" name="background" class="form-control" >
</div>

<div class="mb-3">
    <label>Align</label>
    <select name="align" class="form-select" required>
        <option value="left">Left</option>
        {{-- <option value="center">Center</option> --}}
        <option value="right">Right</option>
    </select>
</div>
