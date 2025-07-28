<style>
    .tox-tinymce {

    height: 500px !important;
}
</style>

<label for="title">Title</label>
<input type="text" name="title" class="form-control"  value="{{ isset($useGuide) ? $useGuide->title : "" }}" required>
<div class="mb-4">
    <label>Thumbnail</label>
    <input type="file" name="thumbnail" class="form-control" id="thumbnailInput" accept="image/*">
    <img id="thumbnailPreview" src="{{ !empty($useGuide->thumbnail) ? asset('storage/' . $useGuide->thumbnail) : '' }}"
        width="80" class="mt-2" style="{{ empty($useGuide->thumbnail) ? 'display: none;' : '' }}">
</div>
<label for="content">Content</label>
<textarea name="content" id="editor" rows="20">{{  isset($useGuide)? $useGuide->content : "" }}</textarea>



<script src="https://cdn.jsdelivr.net/npm/tinymce@6.8.2/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        selector: '#editor',
        plugins: 'image media link code',
        toolbar: 'undo redo | bold italic underline | link image media | code',
        automatic_uploads: true,
        images_upload_url: '{{ route('admin.UseGuide.uploadImage') }}',
        images_upload_credentials: true,
        file_picker_types: 'image media', // 👈 خليها تدعم الاثنين
        relative_urls: false,
        convert_urls: false,
        extended_valid_elements: 'iframe[src|frameborder|style|scrolling|class|width|height|name|align|allowfullscreen|loading]',

        file_picker_callback: function(cb, value, meta) {
            let input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*,video/*'); // 👈 يقبل صورة أو فيديو

            input.onchange = function() {
                let file = this.files[0];
if (file.size > 20 * 1024 * 1024) { // 20MB
    alert("File too large!");
    return;
}

                let formData = new FormData();
                formData.append('file', file);
                formData.append('_token', '{{ csrf_token() }}');

                fetch('{{ route('admin.UseGuide.uploadImage') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData,
                        credentials: 'same-origin'
                    })
                    .then(res => res.json())
                    .then(data => {
                        // 👇 لو صورة أو فيديو نحطه بشكل مناسب
                        if (file.type.startsWith('image/')) {
                            cb(data.location, {
                                title: file.name
                            });
                        } else if (file.type.startsWith('video/')) {
                            cb(data.location, {
                                title: file.name,
                                source2: data.location,
                                poster: '' // صورة مصغرة لو تحب تضيف واحدة
                            });
                        }
                    })
                    .catch(err => console.error(err));
            };

            input.click();
        }
    });
</script>
