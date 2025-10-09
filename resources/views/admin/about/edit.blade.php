@extends('admin.app')
@php
    $title = 'About Page';
    $sub_title = 'Pages';
@endphp
@section('title', $title)

@section('content')
<div class="d-flex flex-column flex-column-fluid">

    <!-- Toolbar -->
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">{{ $title }}</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <a class="text-muted text-hover-primary">{{ $sub_title }}</a>
                    </li>
                    <li class="breadcrumb-item"><span class="bullet bg-gray-400 w-5px h-2px"></span></li>
                    <li class="breadcrumb-item text-muted">{{ $title }}</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit About Page</h3>
                </div>
                <div class="card-body p-lg-10">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Title -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Title</label>
                            <input type="text" name="title" value="{{ old('title', $about->title) }}" class="form-control" required>
                        </div>

                        <!-- Desktop Background -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Background (Desktop)</label>
                            @if ($about->background_desktop)
                                <div class="mb-2">
                                    <img id="preview_desktop_existing" src="{{ asset('storage/' . $about->background_desktop) }}" width="200" class="img-thumbnail">
                                </div>
                            @endif
                            <div class="mb-2">
                                <img id="preview_desktop" style="max-width: 200px; display: none;" class="img-thumbnail">
                            </div>
                            <input type="file" name="background_desktop" class="form-control" accept="image/*" onchange="previewImage(event, 'preview_desktop')">
                        </div>

                        <!-- Mobile Background -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Background (Mobile)</label>
                            @if ($about->background_mobile)
                                <div class="mb-2">
                                    <img id="preview_mobile_existing" src="{{ asset('storage/' . $about->background_mobile) }}" width="200" class="img-thumbnail">
                                </div>
                            @endif
                            <div class="mb-2">
                                <img id="preview_mobile" style="max-width: 200px; display: none;" class="img-thumbnail">
                            </div>
                            <input type="file" name="background_mobile" class="form-control" accept="image/*" onchange="previewImage(event, 'preview_mobile')">
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" rows="5" class="form-control" required>{{ old('description', $about->description) }}</textarea>
                        </div>
                        <!-- Description -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Text</label>
                            <textarea name="text" rows="5" class="form-control" required>{{ old('text', $about->text) }}</textarea>
                        </div>

                        <!-- Submit -->
                        @can('about page-edit background')
                        <div>
                            <button type="submit" class="btn btn-primary w-100">Update</button>
                        </div>
                        @endcan
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    function previewImage(event, id) {
        const input = event.target;
        const reader = new FileReader();
        const preview = document.getElementById(id);

        reader.onload = function(){
            preview.src = reader.result;
            preview.style.display = 'block';
        };

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
