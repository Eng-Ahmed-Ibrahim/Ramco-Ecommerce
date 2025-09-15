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
    <label>Details</label>
    <textarea name="details" class="form-control" rows="4" required>{{ old('details', $product->details ?? '') }}</textarea>
</div>

<div class="mb-5">
    <label class="form-label">Features</label>
    <div id="feature-container">
        @php $featureIndex = 0; @endphp
        @if (!empty($product->features))
            @foreach ($product->features as $feature)
                <div class="row mb-2 feature-row">
                    <div class="col-md-5">
                        <input type="text" name="features[{{ $featureIndex }}][key]" class="form-control"
                            value="{{ old("features.$featureIndex.key", $feature->key) }}" placeholder="Feature Name">
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="features[{{ $featureIndex }}][value]" class="form-control"
                            value="{{ old("features.$featureIndex.value", $feature->value) }}"
                            placeholder="Feature Description">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-feature">
                            <i class="fa-solid fa-xmark p-0" style="font-size: 18px;color:white;"></i>
                        </button>
                    </div>
                </div>
                @php $featureIndex++; @endphp
            @endforeach
        @else
            <div class="row mb-2 feature-row">
                <div class="col-md-5">
                    <input type="text" name="features[0][key]" class="form-control" placeholder="Feature Name">
                </div>
                <div class="col-md-5">
                    <input type="text" name="features[0][value]" class="form-control"
                        placeholder="Feature Description">
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-feature">
                        <i class="fa-solid fa-xmark p-0" style="font-size: 18px;color:white;"></i>
                    </button>
                </div>
            </div>
            @php $featureIndex = 1; @endphp
        @endif
    </div>

    <button type="button" class="btn btn-sm btn-secondary" id="add-feature">Add Feature</button>
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
    <img id="thumbnailPreview" src="{{ !empty($product->thumbnail) ? asset('storage/' . $product->thumbnail) : '' }}"
        width="80" class="mt-2" style="{{ empty($product->thumbnail) ? 'display: none;' : '' }}">
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
    document.getElementById('thumbnailInput')?.addEventListener('change', function(e) {
        const [file] = this.files;
        if (file) {
            const preview = document.getElementById('thumbnailPreview');
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });

    // ✅ Preview for Gallery Images
    document.getElementById('galleriesInput')?.addEventListener('change', function(e) {
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



<script>
    let featureIndex = 1;

    document.getElementById('add-feature').addEventListener('click', function() {
        const container = document.getElementById('feature-container');
        const html = `
        <div class="row mb-2 feature-row">
            <div class="col-md-5">
                <input type="text" name="features[${featureIndex}][key]" class="form-control" placeholder="Feature Name">
            </div>
            <div class="col-md-5">
                <input type="text" name="features[${featureIndex}][value]" class="form-control" placeholder="Feature description">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger remove-feature">
                    <i class="fa-solid fa-xmark p-0" style="font-size: 18px;color:white;"></i>
                </button>
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', html);
        featureIndex++;
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-feature')) {
            e.target.closest('.feature-row').remove();
        }
    });
</script>
