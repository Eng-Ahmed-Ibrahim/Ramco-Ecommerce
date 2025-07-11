<div class="mb-4">
    <label>Name</label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="form-control" required>
</div>
<div class="mb-4">
    <label>Model</label>
    <input type="text" name="model" value="{{ old('model', $product->model ?? '') }}" class="form-control" required>
</div>
<div class="mb-4">
    <label>Description</label>
    <textarea name="description" class="form-control" rows="4" required>{{ old('description', $product->description ?? '') }}</textarea>
</div>
<div class="mb-4">
    <label>Colors</label>
    <input type="text" name="colors" id="colorsInput" class="form-control" value='@json(old('colors', $product->colors ?? []))'
        placeholder="Type color and press Enter" required>
</div>

<div class="mb-4">
    <label>Price</label>
    <input type="number" name="price" value="{{ old('price', $product->price ?? '') }}" class="form-control"
        required>
</div>

<div class="mb-4">
    <label>Weight</label>
    <input type="text" name="weight" value="{{ old('weight', $product->weight ?? '') }}" class="form-control"
        required>
</div>

<div class="mb-4">
    <label>Dimensions</label>
    <input type="text" name="dimensions" value="{{ old('dimensions', $product->dimensions ?? '') }}"
        class="form-control" required>
</div>

<div class="mb-4">
    <label>Cooling Power</label>
    <input type="text" name="cooling_power" value="{{ old('cooling_power', $product->cooling_power ?? '') }}"
        class="form-control" required>
</div>
<div class="mb-4">
    <label>Details</label>
    <textarea name="details" class="form-control" rows="4" required>{{ old('details', $product->details ?? '') }}</textarea>
</div>


<div class="mb-4">
    <label>Category</label>
    <select name="category_id" class="form-control" required>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>


<div class="mb-4">
    <label>Sub Category</label>
    <select name="sub_category_id" class="form-control" required>
        @foreach ($subCategories as $sub)
            <option value="{{ $sub->id }}" @selected(old('sub_category_id', $product->sub_category_id ?? '') == $sub->id)>
                {{ $sub->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-4">
    <label>Thumbnail</label>
    <input type="file" name="thumbnail" class="form-control" id="thumbnailInput" accept="image/*">
    <img id="thumbnailPreview" src="{{ !empty($product->thumbnail) ? asset('storage/' . $product->thumbnail) : '' }}" width="80" class="mt-2" style="{{ empty($product->thumbnail) ? 'display: none;' : '' }}">
</div>
<div class="mb-4">
    <label>Gallery Images</label>
    <input type="file" name="galleries[]" class="form-control" multiple accept="image/*" id="galleriesInput">
</div>

<div class="mt-2 d-flex flex-wrap gap-2" id="galleryPreview">
    @if (!empty($product->galleries))
        @foreach ($product->galleries as $gallery)
            <img src="{{ asset('storage/' . $gallery->image) }}" width="80">
        @endforeach
    @endif
</div>



{{-- Tagify  --}}
<style>
    .tagify.form-control {
        display: flex;
        align-items: center;
        gap: 0.25rem;
        padding: 0 5px;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css">
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script>
    let input = document.querySelector('#colorsInput');
    new Tagify(input);
</script>

{{-- Privew thumbnail and galleries --}}
<script>
    // ✅ Preview for Thumbnail
    document.getElementById('thumbnailInput')?.addEventListener('change', function (e) {
        const [file] = this.files;
        if (file) {
            const preview = document.getElementById('thumbnailPreview');
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });

    // ✅ Preview for Gallery Images
    document.getElementById('galleriesInput')?.addEventListener('change', function (e) {
        const previewContainer = document.getElementById('galleryPreview');
        // previewContainer.innerHTML = ''; // Clear old previews

        Array.from(this.files).forEach(file => {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.width = 80;
            img.classList.add('me-2', 'mb-2');
            previewContainer.appendChild(img);
        });
    });
</script>

